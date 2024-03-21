<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces;
use App\Repositories;
use Dotenv\Repository\RepositoryInterface;
use Illuminate\Cache\Repository;

class RepositoryServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Interfaces\UserInterface::class, Repositories\UserRepository::class);
        $this->app->bind(Interfaces\SkillInterface::class, Repositories\SkillRepository::class);
        // $this->app->bind(Interfaces\TourismCategoryInterface::class, Repositories\TourismCategoryRepository::class);
        // $this->app->bind(Interfaces\EventCategoryInterface::class, Repositories\EventCategoryRepository::class);
        // $this->app->bind(Interfaces\CulinaryCategoryInterface::class, Repositories\CulinaryCategoryRepository::class);
        // $this->app->bind(Interfaces\HotelCategoryInterface::class, Repositories\HotelCategoryRepository::class);
        // $this->app->bind(Interfaces\LanguageInterface::class, Repositories\LanguageRepository::class);
        // $this->app->bind(Interfaces\TourGuideInterface::class, Repositories\TourGuideRepository::class);
        // $this->app->bind(Interfaces\TourGuideFileInterface::class, Repositories\TourGuideFileRepository::class);
        // $this->app->bind(Interfaces\JurisdictionInterface::class, Repositories\JurisdictionRepository::class);
        // $this->app->bind(Interfaces\DestinationInterface::class, Repositories\DestinationRepository::class);
        // $this->app->bind(Interfaces\BusSsctInterface::class, Repositories\BusSsctRepository::class);
        // $this->app->bind(Interfaces\EventInterface::class, Repositories\EventRepository::class);
        // $this->app->bind(Interfaces\EbookInterface::class, Repositories\EbookRepository::class);
        // $this->app->bind(Interfaces\EbookFileInterface::class, Repositories\EbookFileRepository::class);
        // $this->app->bind(Interfaces\CulinaryInterface::class, Repositories\CulinaryRepository::class);
        // $this->app->bind(Interfaces\HotelInterface::class, Repositories\HotelRepository::class);
        // $this->app->bind(Interfaces\HotelFileInterface::class, Repositories\HotelFileRepository::class);
        // $this->app->bind(Interfaces\ContentPageInterface::class, Repositories\ContentPageRepository::class);
        // $this->app->bind(Interfaces\TransportationInterface::class, Repositories\TransportationRepository::class);
        // $this->app->bind(Interfaces\GalleryInterface::class, Repositories\GalleryRepository::class);
        // $this->app->bind(Interfaces\ArticleInterface::class, Repositories\ArticleRepository::class);
        // $this->app->bind(Interfaces\MenuHeaderInterface::class, Repositories\MenuHeaderRepository::class);
        // $this->app->bind(Interfaces\InstagramInterface::class, Repositories\InstagramRepository::class);
        // $this->app->bind(Interfaces\ArticleFileInterface::class, Repositories\ArticleFileRepository::class);
        // $this->app->bind(Interfaces\ArticleFileInterface::class, Repositories\ArticleFileRepository::class);
        // $this->app->bind(Interfaces\ContentPageFileInterface::class, Repositories\ContentPageFileRepository::class);
        // $this->app->bind(Interfaces\CulinaryOpeningHourInterface::class, Repositories\CulinaryOpeningHourRepository::class);
        // $this->app->bind(Interfaces\CulinaryFileInterface::class, Repositories\CulinaryFileRepository::class);
        // $this->app->bind(Interfaces\CulinaryCategoryCulinariesInterface::class, Repositories\CulinaryCategoryCulinariesRepository::class);
        // $this->app->bind(Interfaces\MenuHeaderFileInterface::class, Repositories\MenuHeaderFileRepository::class);
        // $this->app->bind(Interfaces\EventFileInterface::class, Repositories\EventFileRepository::class);
        // $this->app->bind(Interfaces\DestinationFileInterface::class, Repositories\DestinationFileRepository::class);
        // $this->app->bind(Interfaces\DestinationOpeningHourInterface::class, Repositories\DestinationOpeningHourRepository::class);
        // $this->app->bind(Interfaces\DestinationTicketPriceInterface::class, Repositories\DestinationTicketPriceRepository::class);
        // $this->app->bind(Interfaces\BusSsctFileInterface::class, Repositories\BusSsctFileRepository::class);
        // $this->app->bind(Interfaces\DestinationSocialMediaInterface::class, Repositories\DestinationSocialMediaRepository::class);
        // $this->app->bind(Interfaces\AdvertisementInterface::class, Repositories\AdvertisementRepository::class);
        // $this->app->bind(Interfaces\AdvertisementFileInterface::class, Repositories\AdvertisementFileRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
};
