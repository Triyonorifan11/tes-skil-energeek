import Home from '@/landing-page/Index.vue';

import WhatsOn from '@/landing-page/whats-on/Index.vue';
import WhatsOnDetail from '@/landing-page/whats-on/Detail.vue';

import Destination from '@/landing-page/destination/Index.vue';
import DestinationDetail from '@/landing-page/destination/Detail.vue';

import Cullnary from '@/landing-page/cullnary/Index.vue';
import CullnaryDetail from '@/landing-page/cullnary/Detail.vue';

import Hotel from '@/landing-page/hotel/Index.vue';
import HotelDetail from '@/landing-page/hotel/Detail.vue';

import Transportation from '@/landing-page/transportation/Index.vue';
import TravelKitMap from '@/landing-page/map/Index.vue';

import Ebook from '@/landing-page/ebook/Index.vue';

import TravelGuide from '@/landing-page/travel-guide/Index.vue';
import TravelGuideDetail from '@/landing-page/travel-guide/Detail.vue';

import BusSSCT from '@/landing-page/bus-ssct/Index.vue';

import StrollAround from '@/landing-page/stroll-around/Index.vue';
import StrollAroundDetail from '@/landing-page/stroll-around/Detail.vue';

import Cakning2023 from '@/landing-page/Cakning2023.vue';

import Nearby from '@/landing-page/nearby/Index.vue'

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home,
        meta: {
            title: 'Home page',
        }
    },
    {
        path: '/cakning-2023',
        name: 'cakning-2023',
        component: Cakning2023,
        meta: {
            title: 'Cakning',
        }
    },
    {
        path: '/whats-on',
        name: 'whats-on',
        component: WhatsOn,
        meta: {
            title: 'Whats On',
        }
    },
    {
        path: '/whats-on/:id',
        name: 'whats-on-detail',
        component: WhatsOnDetail,
        meta: {
            title: 'Whats On Detail',
        }
    },
    {
        path: '/destination',
        name: 'destination',
        component: Destination,
        meta: {
            title: 'Destination',
        }
    },
    {
        path: '/destination/:id',
        name: 'destination-detail',
        component: DestinationDetail,
        meta: {
            title: 'Destination Detail',
        }
    },
    {
        path: '/cullnary',
        name: 'cullnary',
        component: Cullnary,
        meta: {
            title: 'Cullinary',
        }
    },
    {
        path: '/cullnary/:id',
        name: 'cullnary-detail',
        component: CullnaryDetail,
        meta: {
            title: 'Cullinary Detail',
        }
    },
    {
        path: '/hotel',
        name: 'accomodation-hotel',
        component: Hotel,
        meta: {
            title: 'Hotel',
        }
    },
    {
        path: '/hotel/:id',
        name: 'accomodation-hotel-detail',
        component: HotelDetail,
        meta: {
            title: 'Hotel Detail',
        }
    },
    {
        path: '/transportation',
        name: 'accomodation-transportation',
        component: Transportation,
        meta: {
            title: 'Transportation',
        }
    },
    {
        path: '/nearby',
        name: 'nearby',
        component: Nearby,
        meta: {
            title: 'Nearby',
        }
    },
    {
        path: '/map',
        name: 'travel-kit-map',
        component: TravelKitMap,
        meta: {
            title: 'Travel Kit Map',
        }
    },
    {
        path: '/ebook',
        name: 'travel-kit-ebook',
        component: Ebook,
        meta: {
            title: 'Travel Kit E-Book',
        }
    },
    {
        path: '/travel-guide',
        name: 'travel-kit-travel-guide',
        component: TravelGuide,
        meta: {
            title: 'Travel Kit Guide',
        }
    },
    {
        path: '/travel-guide/:id',
        name: 'travel-kit-travel-guide-detail',
        component: TravelGuideDetail,
        meta: {
            title: 'Travel Kit Guide Detail',
        }
    },
    {
        path: '/bus-ssct',
        name: 'travel-kit-bus-ssct',
        component: BusSSCT,
        meta: {
            title: 'Bus SSCT',
        }
    },
    {
        path: '/stroll-around',
        name: 'stroll-around',
        component: StrollAround,
        meta: {
            title: 'Stroll Around',
        }
    },
    {
        path: '/stroll-around/:id',
        name: 'stroll-around-detail',
        component: StrollAroundDetail,
        meta: {
            title: 'Stroll Around Detail',
        }
    },

]


export default routes
