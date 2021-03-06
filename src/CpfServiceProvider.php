<?php

namespace ValidationCPF;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use ValidationCPF\Validate\CpfValidation;

class CpfServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->publicFileCpf();

        $this->validationCpf();

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Public arquivo Cpf
     */
    public function publicFileCpf()
    {
        $this->publishes([
            __DIR__ . '/config/config.php' => config_path('cpf.php'),
        ]);
    }

    /**
     * Validation Cpf
     */
    public function validationCpf()
    {
        Validator::extend('cpf', function ($attribute, $value, $parameters, $validator) {
            return (new CpfValidation($value))->validateCpf();
        }, config('cpf.message'));
    }

}
