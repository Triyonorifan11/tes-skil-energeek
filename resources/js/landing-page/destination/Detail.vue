    <template>
        <div>
            <app-landing-page-navbar></app-landing-page-navbar>
            <div class="content bg-content-custom pb-5">
                <section class="pt-5">
                    <div class="container">
                        <div class="d-flex flex-wrap align-items-center">
                            <div style="font-weight:500">Detail Destination</div>
                            <div class="mx-3" style="color:#B5B5C3">|</div>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb" style="font-size:14px;margin-bottom: 0 !important;">
                                    <li class="breadcrumb-item" style="color:#B5B5C3 !important">
                                        <router-link to="/">Home</router-link>
                                    </li>
                                    <li class="breadcrumb-item" style="color:#B5B5C3 !important">
                                        <router-link to="/destination">Destination</router-link>
                                    </li>
                                    <li class="breadcrumb-item active" style="color:#B5B5C3 !important"
                                        aria-current="page">
                                        Detail</li>
                                </ol>
                            </nav>
                        </div>
                        <template v-if="pageStatus == 'page-load'">
                            <div class="d-flex justify-content-center mt-5 mb-5">
                                <app-loader></app-loader>
                            </div>

                        </template>
                        <template v-else>
                            <div class="row">
                                <div class="col-lg-7 mt-3">
                                    <div class="d-flex justify-content-center w-100"><img :src="`${mainPreviewImage}`" @error="$setNoImageUrl"
                                            class="mb-3"
                                            style="max-width:100%;object-fit:cover;object-position:center;"></div>
                                    <div class="slider-gallery-image">
                                        <img :src="`${a.link}`" @error="$setNoImageUrl" v-for="a in data.touristDestinationFiles"
                                            @click="mainPreviewImage = a.link" class="me-3 slider-option-detail-image">
                                    </div>
                                    <div class="fw-bolder fs-3 pt-3">
                                        {{ $getTitleEventsOrDestination(data.touristDestinationLanguages) }}
                                    </div>
                                    <div style="color:#3F4254" class="pt-3">
                                        <div
                                            v-html="$getDescriptionEventsOrDestination(data.touristDestinationLanguages)">
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mt-3 mb-5">
                                        <div class="pe-3">Share</div>
                                        <div class="d-flex align-items-center">
                                            <ShareNetwork class="me-3" network="facebook" :url="currentUrl"
                                                :title="$getTitleEventsOrDestination(data.touristDestinationLanguages)"
                                                :description="$getDescriptionEventsOrDestination(data.touristDestinationLanguages)">
                                                <svg width="33" height="32" viewBox="0 0 33 32" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M29.8332 16.0003C29.8332 8.64032 23.8598 2.66699 16.4998 2.66699C9.13984 2.66699 3.1665 8.64032 3.1665 16.0003C3.1665 22.4537 7.75317 27.827 13.8332 29.067V20.0003H11.1665V16.0003H13.8332V12.667C13.8332 10.0937 15.9265 8.00032 18.4998 8.00032H21.8332V12.0003H19.1665C18.4332 12.0003 17.8332 12.6003 17.8332 13.3337V16.0003H21.8332V20.0003H17.8332V29.267C24.5665 28.6003 29.8332 22.9203 29.8332 16.0003Z"
                                                        fill="#3699FF" />
                                                </svg></ShareNetwork>
                                            <ShareNetwork class="me-3" network="twitter" :url="currentUrl"
                                                :title="$getTitleEventsOrDestination(data.touristDestinationLanguages)"
                                                :description="$getDescriptionEventsOrDestination(data.touristDestinationLanguages)">
                                                <svg width="33" height="32" viewBox="0 0 33 32" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M30.4466 7.99967C29.4199 8.46634 28.3132 8.77301 27.1666 8.91967C28.3399 8.21301 29.2466 7.09301 29.6732 5.74634C28.5666 6.41301 27.3399 6.87967 26.0466 7.14634C24.9932 5.99967 23.5132 5.33301 21.8332 5.33301C18.6999 5.33301 16.1399 7.89301 16.1399 11.053C16.1399 11.5063 16.1932 11.9463 16.2866 12.3597C11.5399 12.1197 7.31322 9.83967 4.49989 6.38634C4.00656 7.22634 3.72656 8.21301 3.72656 9.25301C3.72656 11.2397 4.72656 12.9997 6.27322 13.9997C5.32656 13.9997 4.44656 13.733 3.67322 13.333V13.373C3.67322 16.1463 5.64656 18.4663 8.25989 18.9863C7.42086 19.216 6.54002 19.2479 5.68656 19.0797C6.0487 20.2163 6.75794 21.2109 7.71458 21.9236C8.67122 22.6363 9.82715 23.0313 11.0199 23.053C8.99806 24.6536 6.49188 25.5188 3.91322 25.5063C3.45989 25.5063 3.00656 25.4797 2.55322 25.4263C5.08656 27.053 8.09989 27.9997 11.3266 27.9997C21.8332 27.9997 27.6066 19.2797 27.6066 11.7197C27.6066 11.4663 27.6066 11.2263 27.5932 10.973C28.7132 10.173 29.6732 9.15967 30.4466 7.99967Z"
                                                        fill="#3699FF" />
                                                </svg>

                                            </ShareNetwork>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 mt-3">
                                    <div class="bg-white p-3 rounded-patern">
                                        <div class="d-flex align-items-center" v-if="data.isSuperior">
                                            <div>
                                                <svg width="25" height="24" viewBox="0 0 25 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M23.5 12L21.06 9.21L21.4 5.52L17.79 4.7L15.9 1.5L12.5 2.96L9.1 1.5L7.21 4.69L3.6 5.5L3.94 9.2L1.5 12L3.94 14.79L3.6 18.49L7.21 19.31L9.1 22.5L12.5 21.03L15.9 22.49L17.79 19.3L21.4 18.48L21.06 14.79L23.5 12ZM10.59 16.72L6.79 12.91L8.27 11.43L10.59 13.76L16.44 7.89L17.92 9.37L10.59 16.72Z"
                                                        fill="#049C4F" />
                                                </svg>
                                            </div>
                                            <div class="ps-3" style="color:#049C4F;font-weight:500;">Recommended
                                                Destination
                                            </div>
                                        </div>
                                        <div class="d-flex flex-wrap mt-3">
                                            <router-link :to="`/destination?id=${a.id}&name=${a.name}`"
                                                class="p-2 me-2 mb-2" v-for="a in data.tourismCategory"
                                                style="background:#E8FFF3;color:#049C4F;border-radius:5px">{{a.name}}
                                            </router-link>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-lg-4 fs-14px">Alamat</div>
                                            <div class="col-lg-8 fs-14px">{{data.address}}
                                            </div>
                                            <div class="col-lg-4 fs-14px mt-3">Jam Buka</div>
                                            <div class="col-lg-8 fs-14px mt-3">
                                                <ul style="list-style-type: none !important;padding:0 !important">
                                                    <li v-for="a in data.touristDestinationOpeningHours" class="mt-2">
                                                        {{a.day}}&ensp;
                                                        <template v-if="a.isClosed">
                                                            Tutup
                                                        </template>
                                                        <template v-else>
                                                            {{a.startTime}} - {{ a.endTime }}
                                                        </template>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-4 fs-14px mt-3">Sosial Media</div>
                                            <div class="col-lg-8 fs-14px mt-3">
                                                <div class="d-flex flex-wrap">
                                                    <template v-for="context in data.touristDestinationSocialMedias">
                                                        <a :href="context.urlAccount" v-if="context.urlAccount" class="me-2">
                                                            <svg width="33" height="32" viewBox="0 0 33 32" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                v-if="context.socialMedia == 'TikTok'">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M5.3 2H27.7C29.2465 2 30.5 3.2535 30.5 4.8V27.2C30.5 28.7465 29.2465 30 27.7 30H5.3C3.7535 30 2.5 28.7465 2.5 27.2V4.8C2.5 3.2535 3.7535 2 5.3 2Z"
                                                                    fill="#010101" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M20.082 27.7596C20.934 27.7596 21.6247 27.0745 21.6247 26.2295C21.6247 25.3844 20.934 24.6992 20.082 24.6992H19.8496C20.7016 24.6992 21.3923 25.3844 21.3923 26.2295C21.3923 27.0745 20.7016 27.7596 19.8496 27.7596H20.082Z"
                                                                    fill="#EE1D51" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M19.8284 24.6992H19.596C18.744 24.6992 18.0532 25.3844 18.0532 26.2295C18.0532 27.0745 18.744 27.7596 19.596 27.7596H19.8284C18.9763 27.7596 18.2856 27.0745 18.2856 26.2295C18.2856 25.3844 18.9763 24.6992 19.8284 24.6992Z"
                                                                    fill="#66C8CF" />
                                                                <path
                                                                    d="M19.8387 26.9734C20.253 26.9734 20.589 26.6403 20.589 26.2294C20.589 25.8185 20.253 25.4854 19.8387 25.4854C19.4243 25.4854 19.0884 25.8185 19.0884 26.2294C19.0884 26.6403 19.4243 26.9734 19.8387 26.9734Z"
                                                                    fill="#010101" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M8.1001 24.0088V24.7844H9.00864V27.7398H9.91752V24.8053H10.6571L10.9106 24.0088H8.1001ZM15.5386 24.0088V24.7844H16.4471V27.7398H17.356V24.8053H18.0955L18.3491 24.0088H15.5386ZM11.0799 24.4489C11.0799 24.2059 11.2782 24.0088 11.5233 24.0088C11.7685 24.0088 11.9671 24.2059 11.9671 24.4489C11.9671 24.692 11.7687 24.8891 11.5233 24.8891C11.2782 24.889 11.0799 24.692 11.0799 24.4489ZM11.0799 25.2036H11.9671V27.7398H11.0799V25.2036ZM12.3476 24.0088V27.7398H13.2352V26.7757L13.5099 26.524L14.3762 27.7608H15.3271L14.0802 25.9581L15.2002 24.8681H14.1226L13.2352 25.7484V24.0088H12.3476ZM21.9202 24.0088V27.7398H22.8079V26.7757L23.0826 26.524L23.9491 27.7608H24.9001L23.6532 25.9581L24.7732 24.8681H23.6955L22.8079 25.7484V24.0088H21.9202Z"
                                                                    fill="white" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M20.551 11.0935C21.7767 11.9692 23.2784 12.4845 24.9002 12.4845V9.3652C24.5932 9.36532 24.2871 9.3333 23.9868 9.26966V11.725C22.3652 11.725 20.8637 11.2097 19.6377 10.334V16.6995C19.6377 19.8839 17.0549 22.4652 13.8691 22.4652C12.6804 22.4652 11.5756 22.106 10.6577 21.49C11.7053 22.5605 13.1661 23.2246 14.7822 23.2246C17.9683 23.2246 20.5511 20.6434 20.5511 17.4589L20.551 11.0935ZM21.6777 7.9465C21.0513 7.26251 20.6401 6.3785 20.551 5.40118V5H19.6855C19.9033 6.24208 20.6464 7.30328 21.6777 7.9465ZM12.6727 19.0465C12.3228 18.5878 12.1336 18.0267 12.1344 17.4498C12.1344 15.9934 13.3158 14.8125 14.7733 14.8125C15.0449 14.8124 15.3148 14.854 15.5737 14.9361V11.7471C15.2712 11.7057 14.966 11.6881 14.6607 11.6946V14.1767C14.4017 14.0947 14.1316 14.053 13.8599 14.0532C12.4025 14.0532 11.2212 15.234 11.2212 16.6906C11.2212 17.7204 11.8117 18.6121 12.6727 19.0465Z"
                                                                    fill="#EE1D52" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M19.6373 10.334C20.8633 11.2097 22.3648 11.725 23.9865 11.725V9.26966C23.0813 9.07702 22.2799 8.60416 21.6774 7.9465C20.6461 7.30328 19.9029 6.24208 19.6851 5H17.4116V17.4588C17.4065 18.9112 16.2271 20.0872 14.7728 20.0872C13.9158 20.0872 13.1544 19.6789 12.6722 19.0465C11.8112 18.6121 11.2207 17.7204 11.2207 16.6906C11.2207 15.234 12.402 14.0532 13.8594 14.0532C14.1386 14.0532 14.4078 14.0966 14.6602 14.1767V11.6946C11.5304 11.7592 9.01318 14.3153 9.01318 17.4589C9.01318 19.0281 9.64005 20.4507 10.6573 21.4901C11.5752 22.1061 12.6801 22.4653 13.8687 22.4653C17.0546 22.4653 19.6373 19.8839 19.6373 16.6996V10.334Z"
                                                                    fill="white" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M23.9866 9.26828V8.60435C23.1703 8.60558 22.3701 8.37709 21.6775 7.945C22.2906 8.61586 23.0979 9.07849 23.9866 9.26828ZM19.6853 4.99862C19.6645 4.87993 19.6485 4.76044 19.6374 4.64044V4.23926H16.4983V16.6981C16.4933 18.1504 15.314 19.3264 13.8596 19.3264C13.4325 19.3264 13.0294 19.2252 12.6724 19.0451C13.1545 19.6776 13.9159 20.0858 14.7729 20.0858C16.2272 20.0858 17.4066 18.9098 17.4118 17.4574V4.99862H19.6853ZM14.6605 11.6932V10.9864C14.3982 10.9505 14.1337 10.9326 13.869 10.9327C10.6828 10.9327 8.1001 13.5141 8.1001 16.6981C8.1001 18.6944 9.11515 20.4537 10.6576 21.4886C9.64032 20.4492 9.01346 19.0266 9.01346 17.4574C9.01346 14.3139 11.5305 11.7578 14.6605 11.6932Z"
                                                                    fill="#69C9D0" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M19.8494 27.7596C20.7014 27.7596 21.3922 27.0745 21.3922 26.2295C21.3922 25.3844 20.7014 24.6992 19.8494 24.6992H19.8283C18.9763 24.6992 18.2856 25.3844 18.2856 26.2295C18.2856 27.0745 18.9763 27.7596 19.8283 27.7596H19.8494ZM19.0887 26.2295C19.0887 25.8184 19.4247 25.4855 19.8391 25.4855C20.2531 25.4855 20.5891 25.8184 20.5891 26.2295C20.5891 26.6405 20.2531 26.9737 19.8391 26.9737C19.4247 26.9736 19.0887 26.6405 19.0887 26.2295Z"
                                                                    fill="white" />
                                                            </svg>
                                                            <svg v-if="context.socialMedia == 'Instagram'" width="33"
                                                                height="32" viewBox="0 0 33 32" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M24.5003 2H8.50045C5.18676 2 2.50049 4.68627 2.50049 7.99996V23.9999C2.50049 27.3135 5.18676 29.9998 8.50045 29.9998H24.5003C27.814 29.9998 30.5003 27.3135 30.5003 23.9999V7.99996C30.5003 4.68627 27.814 2 24.5003 2Z"
                                                                    fill="url(#paint0_radial_2003_16652)" />
                                                                <path
                                                                    d="M24.5003 2H8.50045C5.18676 2 2.50049 4.68627 2.50049 7.99996V23.9999C2.50049 27.3135 5.18676 29.9998 8.50045 29.9998H24.5003C27.814 29.9998 30.5003 27.3135 30.5003 23.9999V7.99996C30.5003 4.68627 27.814 2 24.5003 2Z"
                                                                    fill="url(#paint1_radial_2003_16652)" />
                                                                <path
                                                                    d="M24.5003 2H8.50045C5.18676 2 2.50049 4.68627 2.50049 7.99996V23.9999C2.50049 27.3135 5.18676 29.9998 8.50045 29.9998H24.5003C27.814 29.9998 30.5003 27.3135 30.5003 23.9999V7.99996C30.5003 4.68627 27.814 2 24.5003 2Z"
                                                                    fill="url(#paint2_radial_2003_16652)" />
                                                                <path
                                                                    d="M23.5 10.5C23.5 11.3284 22.8284 12 22 12C21.1716 12 20.5 11.3284 20.5 10.5C20.5 9.67157 21.1716 9 22 9C22.8284 9 23.5 9.67157 23.5 10.5Z"
                                                                    fill="white" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M16.5005 20.9999C19.2618 20.9999 21.5004 18.7613 21.5004 16C21.5004 13.2386 19.2618 11 16.5005 11C13.7391 11 11.5005 13.2386 11.5005 16C11.5005 18.7613 13.7391 20.9999 16.5005 20.9999ZM16.5005 18.9999C18.1573 18.9999 19.5004 17.6569 19.5004 16C19.5004 14.3431 18.1573 13 16.5005 13C14.8436 13 13.5005 14.3431 13.5005 16C13.5005 17.6569 14.8436 18.9999 16.5005 18.9999Z"
                                                                    fill="white" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M6.5 15.5999C6.5 12.2397 6.5 10.5595 7.15396 9.27604C7.72919 8.14707 8.64707 7.22919 9.77604 6.65396C11.0595 6 12.7397 6 16.0999 6H16.8999C20.2602 6 21.9404 6 23.2238 6.65396C24.3528 7.22919 25.2707 8.14707 25.8459 9.27604C26.4999 10.5595 26.4999 12.2397 26.4999 15.5999V16.3999C26.4999 19.7602 26.4999 21.4404 25.8459 22.7238C25.2707 23.8528 24.3528 24.7707 23.2238 25.3459C21.9404 25.9999 20.2602 25.9999 16.8999 25.9999H16.0999C12.7397 25.9999 11.0595 25.9999 9.77604 25.3459C8.64707 24.7707 7.72919 23.8528 7.15396 22.7238C6.5 21.4404 6.5 19.7602 6.5 16.3999V15.5999ZM16.0999 7.99999H16.8999C18.6131 7.99999 19.7776 8.00155 20.6778 8.07509C21.5547 8.14673 22.0031 8.27657 22.3159 8.43595C23.0685 8.81945 23.6804 9.43137 24.0639 10.184C24.2233 10.4968 24.3532 10.9452 24.4248 11.8221C24.4983 12.7223 24.4999 13.8867 24.4999 15.5999V16.3999C24.4999 18.1131 24.4983 19.2776 24.4248 20.1778C24.3532 21.0547 24.2233 21.5031 24.0639 21.8159C23.6804 22.5685 23.0685 23.1804 22.3159 23.5639C22.0031 23.7233 21.5547 23.8532 20.6778 23.9248C19.7776 23.9983 18.6131 23.9999 16.8999 23.9999H16.0999C14.3867 23.9999 13.2223 23.9983 12.3221 23.9248C11.4452 23.8532 10.9968 23.7233 10.684 23.5639C9.93137 23.1804 9.31945 22.5685 8.93595 21.8159C8.77657 21.5031 8.64673 21.0547 8.57509 20.1778C8.50155 19.2776 8.49999 18.1131 8.49999 16.3999V15.5999C8.49999 13.8867 8.50155 12.7223 8.57509 11.8221C8.64673 10.9452 8.77657 10.4968 8.93595 10.184C9.31945 9.43137 9.93137 8.81945 10.684 8.43595C10.9968 8.27657 11.4452 8.14673 12.3221 8.07509C13.2223 8.00155 14.3867 7.99999 16.0999 7.99999Z"
                                                                    fill="white" />
                                                                <defs>
                                                                    <radialGradient id="paint0_radial_2003_16652" cx="0"
                                                                        cy="0" r="1" gradientUnits="userSpaceOnUse"
                                                                        gradientTransform="translate(12.5004 22.9999) rotate(-55.3758) scale(25.5194)">
                                                                        <stop stop-color="#B13589" />
                                                                        <stop offset="0.79309" stop-color="#C62F94" />
                                                                        <stop offset="1" stop-color="#8A3AC8" />
                                                                    </radialGradient>
                                                                    <radialGradient id="paint1_radial_2003_16652" cx="0"
                                                                        cy="0" r="1" gradientUnits="userSpaceOnUse"
                                                                        gradientTransform="translate(11.5004 30.9998) rotate(-65.1363) scale(22.594)">
                                                                        <stop stop-color="#E0E8B7" />
                                                                        <stop offset="0.444662" stop-color="#FB8A2E" />
                                                                        <stop offset="0.71474" stop-color="#E2425C" />
                                                                        <stop offset="1" stop-color="#E2425C"
                                                                            stop-opacity="0" />
                                                                    </radialGradient>
                                                                    <radialGradient id="paint2_radial_2003_16652" cx="0"
                                                                        cy="0" r="1" gradientUnits="userSpaceOnUse"
                                                                        gradientTransform="translate(1.0005 2.99999) rotate(-8.1301) scale(38.8906 8.3183)">
                                                                        <stop offset="0.156701" stop-color="#406ADC" />
                                                                        <stop offset="0.467799" stop-color="#6A45BE" />
                                                                        <stop offset="1" stop-color="#6A45BE"
                                                                            stop-opacity="0" />
                                                                    </radialGradient>
                                                                </defs>
                                                            </svg>
                                                            <svg v-if="context.socialMedia == 'Facebook'" width="33"
                                                                height="32" viewBox="0 0 33 32" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M30.5001 15.9999C30.5001 12.2869 29.0251 8.72597 26.3996 6.10048C23.7741 3.47499 20.2132 2.00001 16.5002 2.00001C12.9749 1.99675 9.57813 3.32358 6.98842 5.71546C4.39871 8.10733 2.8067 11.3882 2.5304 14.9026C2.25409 18.4171 3.31383 21.9064 5.49793 24.6736C7.68203 27.4408 10.8297 29.2821 14.3122 29.8298V20.0459H10.7602V15.9999H14.3142V12.9159C14.3142 9.40796 16.4042 7.46797 19.6021 7.46797C21.1341 7.46797 22.7361 7.74197 22.7361 7.74197V11.1879H20.9701C19.2301 11.1879 18.6901 12.2679 18.6901 13.3739V15.9999H22.5721L21.9521 20.0459H18.6881V29.8298C21.9811 29.3084 24.98 27.629 27.1453 25.0938C29.3106 22.5586 30.5001 19.3339 30.5001 15.9999Z"
                                                                    fill="#1877F2" />
                                                                <path
                                                                    d="M21.9502 20.0457L22.5702 15.9998H18.6882V13.3738C18.6882 12.2678 19.2282 11.1878 20.9682 11.1878H22.7342V7.73982C22.7342 7.73982 21.1322 7.46582 19.6002 7.46582C16.4002 7.46582 14.3122 9.40581 14.3122 12.9138V15.9998H10.7603V20.0457H14.3142V29.8297C15.764 30.0578 17.2405 30.0578 18.6902 29.8297V20.0457H21.9502Z"
                                                                    fill="white" />
                                                            </svg>
                                                            <svg v-if="context.socialMedia == 'Twitter'" width="33"
                                                                height="32" viewBox="0 0 33 32" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <g clip-path="url(#clip0_2003_16662)">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M32.4995 5.82385C31.3237 6.3593 30.0578 6.72141 28.7298 6.8832C30.0859 6.05113 31.1265 4.73176 31.6167 3.16007C30.347 3.93051 28.944 4.49099 27.4451 4.79146C26.2505 3.48365 24.5432 2.66699 22.6536 2.66699C19.0305 2.66699 16.091 5.68131 16.091 9.39866C16.091 9.92641 16.1473 10.4388 16.26 10.9318C10.8037 10.6506 5.96714 7.97336 2.72713 3.89583C2.16177 4.89355 1.8387 6.05113 1.8387 7.28382C1.8387 9.61824 2.99761 11.6792 4.75942 12.8868C3.68505 12.8541 2.67078 12.5478 1.78424 12.047V12.1299C1.78424 15.3926 4.04755 18.1142 7.05278 18.7305C6.50244 18.8885 5.92206 18.9675 5.3229 18.9675C4.90029 18.9675 4.48707 18.927 4.087 18.848C4.92282 21.5215 7.34578 23.4687 10.2195 23.5207C7.97312 25.3274 5.1407 26.4041 2.06598 26.4041C1.53631 26.4041 1.01228 26.3733 0.499512 26.3116C3.40519 28.2184 6.85744 29.3337 10.5633 29.3337C22.6405 29.3337 29.2426 19.0772 29.2426 10.1807C29.2426 9.88789 29.237 9.59512 29.2257 9.30814C30.5085 8.35857 31.6224 7.17404 32.4995 5.82385Z"
                                                                        fill="#00AAEC" />
                                                                </g>
                                                                <defs>
                                                                    <clipPath id="clip0_2003_16662">
                                                                        <rect width="32" height="32" fill="white"
                                                                            transform="translate(0.499512)" />
                                                                    </clipPath>
                                                                </defs>
                                                            </svg>
                                                            <svg v-if="context.socialMedia == 'YouTube'" width="33"
                                                                height="32" viewBox="0 0 33 32" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <g clip-path="url(#clip0_2003_16666)">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M13.1959 20.1792L13.1949 11.1245L21.8409 15.6674L13.1959 20.1792ZM32.1798 9.55543C32.1798 9.55543 31.8668 7.3348 30.9078 6.35692C29.6908 5.07289 28.3268 5.06683 27.7018 4.99231C23.2238 4.66601 16.5069 4.66602 16.5069 4.66602H16.4929C16.4929 4.66602 9.77594 4.66601 5.29797 4.99231C4.67198 5.06683 3.30898 5.07289 2.09099 6.35692C1.132 7.3348 0.819995 9.55543 0.819995 9.55543C0.819995 9.55543 0.5 12.1638 0.5 14.7711V17.2163C0.5 19.8247 0.819995 22.432 0.819995 22.432C0.819995 22.432 1.132 24.6527 2.09099 25.6306C3.30898 26.9146 4.90796 26.8743 5.61996 27.0082C8.17994 27.256 16.4999 27.3325 16.4999 27.3325C16.4999 27.3325 23.2238 27.3225 27.7018 26.9962C28.3268 26.9206 29.6908 26.9146 30.9078 25.6306C31.8668 24.6527 32.1798 22.432 32.1798 22.432C32.1798 22.432 32.4998 19.8247 32.4998 17.2163V14.7711C32.4998 12.1638 32.1798 9.55543 32.1798 9.55543Z"
                                                                        fill="#CE1312" />
                                                                </g>
                                                                <defs>
                                                                    <clipPath id="clip0_2003_16666">
                                                                        <rect width="31.9998" height="31.9998"
                                                                            fill="white"
                                                                            transform="translate(0.499512)" />
                                                                    </clipPath>
                                                                </defs>
                                                            </svg>



                                                        </a>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="background-color: #F3F6F9;" class="p-3 rounded-patern mt-3">
                                            <div class="c-primary-custom pb-1 text-center mb-2"
                                                style="border-bottom: 1px #049C4F solid;width:60px">Tiket</div>
                                            <div class="bg-white rounded-patern p-3">
                                                <div class="text-center fw-bolder" style="color:#0E5CA8"
                                                    v-if="data.isFreeForAll">Gratis</div>
                                                <div class="row" v-else>
                                                    <template v-for="a in data.touristDestinationTicketPrices">
                                                        <div class="col-lg-6 my-1 fs-14px">{{a.name}}</div>
                                                        <div class="col-lg-6 my-1 fs-14px fw-bolder text-right"
                                                            style="color:#0E5CA8">
                                                            {{ a.price == 0 ? 'Gratis' : $rupiahFormat(parseFloat(a.price ? a.price : 0 )) }}
                                                        </div>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-lg-12 mb-1" v-if="data?.websiteLink">
                                                <a :href="data.websiteLink" target="_blank"
                                                    style="border: 1px #049C4F  solid;border-radius: 15px;padding:15px;"
                                                    class="btn c-primary-custom text-center w-100 fs-15px mt-3">
                                                    Information Desk</a>
                                            </div>
                                            <div class="col-lg-12 mb-1" v-if="data?.contact">
                                                <a :href="`tel:${data.contact}`"
                                                    style="border-radius: 15px;padding:15px;"
                                                    class="btn bg-primary-custom text-white text-center w-100 fs-15px mt-3"><svg
                                                        width="28" height="28" viewBox="0 0 28 28" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M13.7192 25.2333C7.51599 25.2333 2.4873 20.2046 2.4873 14.0014C2.4873 7.79822 7.51599 2.76953 13.7192 2.76953C19.9224 2.76953 24.9511 7.79822 24.9511 14.0014C24.9511 20.2046 19.9224 25.2333 13.7192 25.2333ZM13.2856 15.3639C12.7856 15.8638 12.0218 15.9878 11.3894 15.6716C10.757 15.3554 9.99325 15.4793 9.4933 15.9793L7.79615 17.6764C7.7345 17.7381 7.68805 17.8132 7.66048 17.8959C7.5624 18.1902 7.72142 18.5082 8.01566 18.6063L9.53626 19.1132C10.9965 19.5999 12.6064 19.2199 13.6948 18.1315L18.1867 13.6396C19.1866 12.6397 19.4345 11.1121 18.8021 9.84734L18.0916 8.42635C18.0646 8.37236 18.0291 8.32308 17.9864 8.2804C17.7671 8.06108 17.4115 8.06108 17.1922 8.2804L15.4035 10.0691C14.9035 10.5691 14.7796 11.3329 15.0958 11.9652C15.412 12.5976 15.288 13.3614 14.7881 13.8614L13.2856 15.3639Z"
                                                            fill="white" />
                                                    </svg>
                                                    &ensp;Hubungi
                                                    Via Telefon</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div id="map"></div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                    <div class="container mt-5" v-if="listTopDestination.length > 0 && pageStatus != 'page-load'">
                        <div class="row align-items-center">
                            <div class="col-lg-10">
                                <div class="fs-3 fw-bolder">Nearby Destination</div>
                            </div>
                            <div class="col-lg-2 d-flex justify-content-end">
                                <div class="d-flex">
                                    <button type="button" class="btn me-2" @click="prevDestinationScroll"
                                        style="padding:5px 3px !important;border:1px #EBEDF3 solid !important;box-shadow:unset !important;"><svg
                                            width="33" height="32" viewBox="0 0 33 32" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M21.4401 22.12L15.3334 16L21.4401 9.88L19.5601 8L11.5601 16L19.5601 24L21.4401 22.12Z"
                                                fill="#5E6278" />
                                        </svg>
                                    </button>
                                    <button type="button" class="btn" @click="nextDestinationScroll"
                                        style="padding:5px 3px !important;border:1px #EBEDF3 solid !important;box-shadow:unset !important;"><svg
                                            width="33" height="32" viewBox="0 0 33 32" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.5601 22.12L17.6667 16L11.5601 9.88L13.4401 8L21.4401 16L13.4401 24L11.5601 22.12Z"
                                                fill="#5E6278" />
                                        </svg>

                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-2 mt-5 mb-5" v-if="listTopDestination.length > 0 && pageStatus != 'page-load'">
                        <div class="slider-destination">
                            <div v-for="a in listTopDestination">
                                <router-link :to="`/destination/${a.id}`">
                                    <div class="list-destination"
                                        :style="`background-image:linear-gradient(359.32deg, rgba(0, 0, 0, 0.5) 10%, rgba(0, 0, 0, 0) 99.42%), url('${a.touristDestinationFiles.length > 0 ? a.touristDestinationFiles[0].link : '-'}'), url('${$noImageUrl()}');`">
                                        <div v-if="a.isSuperior" class="recomended"><svg width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M12 17.9999L7.91565 20.1472C7.42681 20.4042 6.82218 20.2163 6.56518 19.7274C6.46284 19.5328 6.42753 19.3098 6.4647 19.0931L7.24475 14.545L3.94042 11.3241C3.54493 10.9386 3.53684 10.3055 3.92234 9.91001C4.07585 9.75252 4.27699 9.65004 4.49463 9.61841L9.06111 8.95486L11.1033 4.81693C11.3477 4.32168 11.9473 4.11834 12.4426 4.36276C12.6398 4.46009 12.7994 4.61972 12.8968 4.81693L14.939 8.95486L19.5054 9.61841C20.052 9.69783 20.4307 10.2053 20.3512 10.7518C20.3196 10.9695 20.2171 11.1706 20.0596 11.3241L16.7553 14.545L17.5354 19.0931C17.6287 19.6374 17.2631 20.1544 16.7188 20.2477C16.502 20.2849 16.2791 20.2496 16.0844 20.1472L12 17.9999Z"
                                                    fill="#FFA800" />
                                            </svg>&ensp;
                                            <span>Recommended</span>
                                        </div>
                                        <router-link :to="`/destination/${a.id}`" class="title">
                                            {{$getTitleEventsOrDestination(a.touristDestinationLanguages)}}
                                        </router-link>
                                        <router-link :to="`/destination/${a.id}`" class="view-more">
                                            Visit&ensp;<svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M9 3L7.9425 4.0575L12.1275 8.25H3V9.75H12.1275L7.9425 13.9425L9 15L15 9L9 3Z"
                                                    fill="white" />
                                            </svg>

                                        </router-link>
                                    </div>
                                </router-link>

                            </div>
                        </div>
                    </div>
                </section>

            </div>
            <app-landing-page-footer></app-landing-page-footer>
        </div>
    </template>
    <script>
        export default {
            data() {
                return {
                    disabledChangePage: false,
                    map: null,
                    currentUrl: window.location.href,
                    listTopDestination: [],
                    surabayaCoordinate: {
                        lat: -7.250445,
                        lng: 112.768845,
                    },
                    pageStatus: 'page-load',
                    mainPreviewImage: null,
                    data: null,
                }
            },
            mounted() {
                reinitPluginLandingPage();
                this.getDetail();
            },
            beforeRouteLeave(to, from, next) {
                if (!this.disabledChangePage) {
                    next();
                }

            },
            methods: {
                getDetail() {
                    this.$axios().get(`stroll-shop/${this.$route.params.id}`)
                        .then(response => {
                            this.pageStatus = 'standby';
                            this.data = response.data.data;

                            this.mainPreviewImage = this.data.touristDestinationFiles.length > 0 ? this.data
                                .touristDestinationFiles[0]
                                .link : '';
                            this.surabayaCoordinate = {
                                lat: Number(this.data.latitude),
                                lng: Number(this.data.longitude)
                            }
                            setTimeout(() => {
                                this.initMap();

                                this.initSlider();
                            }, 500);

                            setTimeout(() => {
                                this.addMarker({
                                    coordinates: {
                                        lat: Number(this.data.latitude),
                                        lng: Number(this.data.longitude)
                                    },
                                    id: 1,
                                });
                            }, 1000);

                            this.getTopDestination();

                        })
                },
                initSlider() {
                    $('.slider-gallery-image').slick({
                        dots: false,
                        infinite: false,
                        arrows: false,
                        speed: 300,
                        slidesToScroll: 2,
                        centerMode: false,
                        variableWidth: true,
                        responsive: [{
                            breakpoint: 991,
                            settings: {
                                slidesToShow: 1
                            }
                        }, ]
                    });


                },
                initMap() {

                    var options = {
                        zoom: 10,
                        center: this.surabayaCoordinate
                    }
                    this.map = new google.maps.Map(document.getElementById('map'), options);
                },
                addMarker(prop) {

                    let that = this;

                    let myLatLng = new google.maps.LatLng(prop.coordinates.lat, prop.coordinates.lng);

                    var marker = new google.maps.Marker({
                        position: myLatLng,
                        map: that.map,
                        animation: google.maps.Animation.DROP,
                    });

                    let name = this.$getTitleEventsOrDestination(this.data.touristDestinationLanguages);
                    let linkGoogleMaps =
                        `https://www.google.com/maps/dir/?api=1&destination=${prop.coordinates.lat},${prop.coordinates.lng}`
                    var information = new google.maps.InfoWindow({
                        content: '<div style="text-align:center;font-weight:600;font-size:14px">' + name +
                            '</div><br><div style="display:flex;justify-content:center"><a style="background:#049C4F;color:#fff;padding:8px 15px;border-radius:10px;font-size:12px;font-weight:500;" href="' +
                            linkGoogleMaps + '" target="_blank">Get Directions</a></div>',
                        maxHeight: 300
                    });

                    google.maps.event.addListener(marker, 'click', function () {
                        information.open(map, marker);
                        that.map.setZoom(15);
                        that.map.setCenter(marker.getPosition());
                    });

                    setTimeout(() => {
                    new google.maps.event.trigger(marker, 'click');
                }, 300);
                },
                getTopDestination() {
                    let params = {
                        page: 1,
                        limit: 10,
                        ignoreId: [this.$route.params.id],
                        latitude: this.data.latitude,
                        longitude: this.data.longitude,
                        sortBy: 'distance',
                        orderBy: 'asc'
                    }
                    this.$axios().get(`stroll-shop`, {
                            params
                        })
                        .then(response => {

                            this.listTopDestination = response.data.data.data;

                            setTimeout(() => {
                                this.initSliderDestination();
                            }, 300);
                        })
                },
                initSliderDestination() {
                    $('.slider-destination').slick({
                        dots: false,
                        accessibility: false,
                        infinite: false,
                        arrows: false,
                        speed: 300,
                        autoplay: false,
                        centerMode: false,
                        variableWidth: true,
                        slidesToScroll: 1,
                        responsive: [{
                                breakpoint: 991,
                                settings: {
                                    slidesToScroll: 1,
                                }
                            },
                            {
                                breakpoint: 576,
                                settings: {
                                    slidesToScroll: 1,
                                }
                            },
                        ]
                    });

                    let that = this;
                    // On before slide change
                    $('.slider-destination').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
                        that.disabledChangePage = true;
                    });
                    // On swipe event
                    $('.slider-destination').on('swipe', function (event, slick, direction) {
                        that.disabledChangePage = true;
                        setTimeout(() => {
                            that.disabledChangePage = false;
                        }, 1000);
                        // left
                    });
                },
                nextDestinationScroll() {
                    $('.slider-destination').slick('slickNext');
                },
                prevDestinationScroll() {
                    $('.slider-destination').slick('slickPrev');
                }
            }
        }

    </script>

    <style scoped>
        .breadcrumb-item+.breadcrumb-item::before {
            content: '-' !important;
            color: #B5B5C3 !important;
        }

        .bg-content-custom {
            background-color: #F5F6FA;
        }

        .slider-option-detail-image {
            width: 230px;
            height: 150px;
            object-fit: cover;
            object-position: center;
            border-radius: 10px;
            cursor: pointer;
        }

        .text-right {
            text-align: right;
        }

        @media(max-width:991px) {
            .slider-option-detail-image {
                width: 170px;
                height: 120px;
                object-fit: cover;
                object-position: center;
            }
        }

        #map {
            height: 250px;
            width: 100%;
            border-radius: 10px;
            margin-bottom: 40px;
        }

        @media(max-width:991px) {
            .bg-content-custom {
                background-color: #fff
            }
        }

        /* //destination */

        .slider-destination .slick-slide {
            margin: 0 10px;
        }

        /* the parent */
        .slider-destination .slick-list {
            margin: 0;
        }

        .list-destination {
            width: 380px;
            height: 500px;
            background-size: cover;
            border-radius: 10px;
            background-position: center;
            padding: 15px;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: end;
        }


        @media(max-width:480px) {
            .list-destination {
                width: 280px !important;
                height: 380px !important;
            }
        }

        .list-destination .title {
            font-size: 20px;
            font-weight: 500;
            padding-bottom: 10px;
            color: #fff;
        }

        .list-destination .view-more {
            color: #fff;
            font-size: 16px;
            margin-top: 5px;
        }

        .list-destination .recomended {
            background-color: #fff;
            font-size: 14px;
            position: absolute;
            display: flex;
            align-items: center;
            top: 15px;
            padding: 3px 10px;
            border-radius: 10px;

        }

        .list-destination .recomended span {
            color: #5E6278;
            font-size: 12px !important;
        }

    </style>
