<?php

namespace Results\Providers;

use Illuminate\Support\Facades\View;
use Results\Callbacks\Admin;
use Results\Fields\Results as ResultsField;
use Results\Fields\Partials\Results as ResultsBuilderField;
use Results\View\Composers\Results as ResultsComposer;
use Log1x\AcfComposer\AcfComposer;

class ResultsServiceProvider implements Provider
{
    protected function providers()
    {
        return [
            RegisterAssets::class,
            RegisterPostType::class,
        ];
    }

    protected function registerFields()
    {
        $composer = app(AcfComposer::class);
        $results = new ResultsField($composer);
        $results->compose();
    }

    protected function registerLayouts()
    {
        add_filter('acf_page_builder_before_build', function ($builder) {
            $fields = $builder->getFields();

            $flexible = null;

            foreach ($fields as $field) {
                if ($field->getName() === 'builder') {
                    $flexible = $field;
                    break;
                }
            }

            if ($flexible) {
                $composer = app(AcfComposer::class);

                $flexible
                    ->addLayout((new ResultsBuilderField($composer))->fields(), [
                        'label' => 'Results',
                        'display' => 'block',
                    ]);
            }

            return $builder;
        });
    }

    public function register()
    {
        foreach ($this->providers() as $service) {
            (new $service)->register();
        }

        $this->registerFields();
        $this->registerLayouts();
        Admin::register();
    }

    public function boot()
    {
        // Register views
        View::addLocation(dirname(dirname(__DIR__)) . '/resources/views');

        View::composer('partials.builder.results', ResultsComposer::class);
    }
}
