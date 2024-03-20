<template>
    <div>
        <app-landing-page-navbar></app-landing-page-navbar>
        <div class="content">
            <div class="d-flex justify-content-center align-items-center flex-column p-5" v-if="header.show"
                :style="`background: rgba(0, 0, 0, .3) url('${header.background}')`"
                style="background-size:cover;width:100%;background-position:center;min-height:250px;background-blend-mode:darken">
                <div class="fw-bolder text-white text-center" style="font-size:30px">{{ header.title }}</div>
                <div class="pt-2 text-white text-center" style="font-size:14px">{{header.description}}</div>
            </div>
            <section>
                <div class="container">
                    <div class="d-flex mt-5 flex-wrap justify-content-center">
                        <div class="c-pointer mx-2 px-3 py-2" @click="flag = 'events'"
                            :style="flag == 'events' ? 'background: #FFFFFF;box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.12);border-radius:10px;' : ''"
                            :class="flag == 'events' ? 'text-black fw-semibolder' : 'text-gray-500'">
                            Events</div>
                        <div class="c-pointer mx-2 px-3 py-2" @click="flag = 'calendar'"
                            :style="flag == 'calendar' ? 'background: #FFFFFF;box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.12);border-radius:10px;' : ''"
                            :class="flag == 'calendar' ? 'text-black fw-semibolder' : 'text-gray-500'">Calendar</div>
                    </div>
                    <template v-if="flag == 'events'">
                        <div class="row justify-content-between align-items-center mt-3">
                            <div class="col-lg-2 mb-3 fw-bolder title-events-head">
                                Events
                            </div>
                            <div class="col-lg-7 justify-content-center d-flex mb-3">
                                <div class="input-group input-group-travel w-100">
                                    <input type="text" class="form-control" placeholder="Type"
                                        v-model="single.filter.search"
                                        v-on:keyup.enter="currentPage = 1; totalDataEvents = 0; getEvents()"
                                        style="border-right: 0 !important;border-top-left-radius:12px;border-bottom-left-radius:12px;box-shadow:unset !important">
                                    <span class="input-group-text"
                                        style="background: #fff;border-top-right-radius:12px;border-bottom-right-radius:12px;padding:2px !important">
                                        <button type="button" @click="currentPage = 1; totalDataEvents = 0; getEvents()"
                                            class="btn bg-primary-custom fs-15px text-white px-4 py-2 rounded-patern">Search</button>
                                    </span>

                                </div>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <app-landing-page-select-single v-model="single.filter.category"
                                    @option-change="currentPage = 1; totalDataEvents = 0; getEvents()"
                                    @change-search="getCategory" :serverside="true"
                                    :loading="pageStatus == 'category-load'" :style="'border-radius:10px !important;'"
                                    :placeholder="'All Categories'" :options="listCategory"
                                    :class="'select-filter-categories'">
                                </app-landing-page-select-single>
                            </div>
                        </div>
                        <template v-if="pageStatus == 'page-load'">
                            <div class="d-flex justify-content-center mt-5 mb-5">
                                <app-loader></app-loader>
                            </div>

                        </template>
                        <template v-else>
                            <div class="row mt-3">
                                <div class="col-lg-12 mb-5 mt-5 text-center" v-if="listEvents.length == 0">
                                    Tidak Ada Data
                                </div>
                                <div class="col-lg-3 col-md-4 mb-5" v-for="context in listEvents">
                                    <router-link :to="`/whats-on/${context.id}`" class="">
                                        <div class="list-whats-on">
                                            <div class="image-box mb-2">
                                                <img :src="`${context.eventThumbnail?.link}`" @error="$setNoImageUrl">
                                                <div class="d-flex justify-content-center">
                                                    <div class="badge-timer">{{context.countdown}}</div>
                                                </div>
                                            </div>
                                            <div class="pt-2 text-gray-600" style="font-size:12px;font-weight: 900;">
                                                {{$moment(context.startDate).format('DD/MM/YYYY  HH:mm')}}
                                                -
                                                {{$moment(context.endDate).format('DD/MM/YYYY  HH:mm')}}
                                            </div>
                                            <div class="title pt-2">{{$getTitleEventsOrDestination(context.eventLanguages)}}
                                            </div>
                                        </div>
                                    </router-link>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center pb-5">
                                <app-landing-page-pagination @change-page="getEvents" :total_data="totalDataEvents"
                                    :limit="12" v-model:current_page="currentPage" :loading="false">
                                </app-landing-page-pagination>
                            </div>
                        </template>
                    </template>
                    <div class="mb-5 fullcalendar-custom-group mt-5" v-if="flag == 'calendar'">
                        <FullCalendar v-if="calendarOptions" :options="calendarOptions" />
                    </div>
                </div>
            </section>
        </div>
        <app-landing-page-footer></app-landing-page-footer>
    </div>
</template>
<script>
    import moment from "moment";
    import FullCalendar from "@fullcalendar/vue3";
    import dayGridPlugin from "@fullcalendar/daygrid";
    import interactionPlugin from "@fullcalendar/interaction";
    import timeGridPlugin from "@fullcalendar/timegrid";
    import listPlugin from "@fullcalendar/list";

    export default {
        components: {
            FullCalendar, // make the <FullCalendar> tag available
        },
        data() {
            return {
                countDownInterval: null,
                header: {
                    show: false,
                    background: '',
                    title: '',
                    description: ''
                },
                pageStatus: 'standby',
                flag: 'events',
                totalDataEvents: 0,
                currentPage: 1,
                listCategory: [],
                calendarOptions: null,
                listEvents: [],
                single: {
                    filter: {
                        category: {}
                    }
                }
            }
        },
        beforeRouteLeave(to, from, next) {

            if (this.countDownInterval) {
                clearInterval(this.countDownInterval);
            }
            next();
        },
        mounted() {
            reinitPluginLandingPage();
            if(this.$route.query.id && this.$route.query.name){
                this.single.filter.category = {
                    id: this.$route.query.id,
                    text: this.$route.query.name
                }
            }
            this.$axios().get(`menu-header-web?headerType=event`)
                .then(response => {
                    this.header.show = true;
                    this.header.background = response.data.data.menuHeaderFile ? response.data.data.menuHeaderFile
                        .link : '';
                    this.header.title = response.data.data.heading;
                    this.header.description = response.data.data.description;
                })
            this.getEvents();
            this.initEventsCalendar();
            this.countDownInterval = setInterval(() => {
                this.reinitCountDownEvent();
            }, 1000)
        },
        methods: {
            reinitCountDownEvent() {
                for (let i = 0; i < this.listEvents.length; i++) {
                    const availableDate = this.$moment(this.listEvents[i].startDate);
                    const endDate = this.$moment(this.listEvents[i].endDate);

                    const currentDate = this.$moment().format();
                    const diffTime = availableDate.diff(currentDate, 'seconds');

                    const diffEndTime = endDate.diff(currentDate);
                    if (diffEndTime < 0) {
                        this.listEvents[i].countdown = 'Sudah Berakhir'
                    }else{
                        if (diffTime < 0) {
                        this.listEvents[i].countdown = 'Sedang Berlangsung'
                    } else {
                        let duration = moment.duration(diffTime * 1000, 'milliseconds');
                        
                        const hours = duration.hours() < 10 ? '0' + duration.hours() + 'h' : duration
                            .hours() + 'h';

                        const days = parseInt(duration.asDays()) < 10 ? '0' + parseInt(duration.asDays()) + 'd' :
                            parseInt(duration
                                .asDays()) + 'd';
                        const minutes = duration.minutes() < 10 ? '0' + duration.minutes() + 'm' : duration
                            .minutes() + 'm';
                        const seconds = duration.seconds() < 10 ? '0' + duration.seconds() + 's' : duration
                            .seconds() + 's';

                        this.listEvents[i].countdown = days + ' : ' + hours + ' : ' + minutes + ' : ' + seconds
                    }
                    }
                 
                }
            },
            getEvents() {
                this.pageStatus = 'page-load';
                let params = {
                    search: this.single.filter.search,
                    page: this.currentPage,
                    limit: 12,
                    isActive: 1,
                    hide: 0,
                }

                if (this.single.filter.category.id) {
                    params.categoryId = this.single.filter.category.id;
                }
                this.$axios().get(`whats-on`, {
                        params
                    })
                    .then(response => {
                        this.pageStatus = 'standby';
                        this.totalDataEvents = response.data.data.total;

                        let dataEvent = response.data.data.data.map(function (el) {
                            const o = Object.assign({}, el);
                            o.countdown = '0d : 0h : 0m : 0s';
                            return o;
                        });
                        this.listEvents = dataEvent;
                    })
            },
            getCategory(keyword, limit) {

                this.pageStatus = 'category-load';

                let params = {
                    search: keyword,
                    limit: limit
                }
                this.$axios().get(`select-list/event-category`, {
                        params
                    })
                    .then(response => {
                        this.listCategory = [];
                        for (let i = 0; i < response.data.data.length; i++) {
                            this.listCategory.push({
                                id: response.data.data[i].id,
                                text: response.data.data[i].name
                            })
                        }
                        this.pageStatus = 'standby';
                    })
                    .catch(error => {
                        this.pageStatus = 'standby';
                    });
            },
            initEventsCalendar() {
                let that = this;
                this.calendarOptions = {
                    dayMaxEvents: 3,
                    contentHeight: 780,
                    eventDisplay: "list-item",
                    plugins: [dayGridPlugin, interactionPlugin, timeGridPlugin, listPlugin],
                    initialView: "dayGridMonth",
                    headerToolbar: {
                        left: "prev,next today",
                        center: "title",
                        right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth",
                    },
                    views: {
                        dayGridMonth: {
                            buttonText: "Month",
                        },
                        timeGridWeek: {
                            buttonText: "Week",
                        },
                        timeGridDay: {
                            buttonText: "Day",
                        },
                        listMonth: {
                            buttonText: "List",
                        },
                    },
                    events: async function (param) {
                        let result = [];
                        let startDate = that.$moment(param.start).format("YYYY-MM-DD");
                        let endDate = that.$moment(param.end).format("YYYY-MM-DD");

                        let params = {
                            start_date: startDate,
                            end_date: endDate
                        }
                        await that.$axios().get(`whats-on/event-calendar`, {
                                params
                            })
                            .then(response => {
                                let events = [];
                                for (let i = 0; i < response.data.data.length; i++) {
                                    events.push({
                                        id: response.data.data[i].id,
                                        title: that.$getTitleEventsOrDestination(response.data.data[
                                            i].eventLanguages),

                                        start: that.$moment(response.data.data[
                                            i].startDate).format('YYYY-MM-DD'),
                                        end: that.$moment(response.data.data[i]
                                            .endDate).format('YYYY-MM-DD'),
                                    });
                                }
                                result = events;
                            });
                        return result;
                    },
                    eventColor: '#049C4F',
                    eventClick: function (info) {
                        that.$router.push({
                            path: '/whats-on/' + info.event.id
                        })
                    }
                };
            },
        }
    }

</script>

<style scoped>
    .select-filter-categories {
        width: 250px
    }

    .input-group-travel {
        max-width: 500px;
    }

    @media(max-width:991px) {
        .select-filter-categories {
            width: 100%;
        }

        .input-group-travel {
            max-width: 100%;
        }

        .title-events-head {
            display: none;
        }
    }

    .list-whats-on {
        border: 1px solid #E4E6EF;
        border-radius: 12px;
        padding: 10px;
    }

    .list-whats-on .title {
        font-size: 18px;
        font-weight: 600;
        color: #049C4F;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        height: 60px;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .list-whats-on .image-box {
        position: relative;
    }

    .list-whats-on .image-box img {
        width: 100%;
        object-fit: cover;
        object-position: center;
        height: 230px;
        border-radius: 10px;
    }

    @media(max-width:991px) {
        .list-whats-on .title {
            font-size: 16px;
        }
    }

    .list-whats-on .badge-timer {
        background-color: rgba(126, 130, 153, 0.82);
        color: #fff;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        position: absolute;
        bottom: 20px;
        letter-spacing: 1.5px;
        padding: 5px 15px;
        font-size: 12px;
    }

</style>
