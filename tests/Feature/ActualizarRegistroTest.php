<?php

namespace Tests\Feature;

//use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;
use App\Models\ServiceOccupation;
use App\Models\ServiceTalent;
use Illuminate\Http\Request;
use Illuminate\Http\Controllers\PerfilController;
use Illuminate\Http\Controllers\ServiceController;
use Tests\TestCase;

class ActualizarRegistroTest extends TestCase
{
    //use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    public function test_perfil_view()
    {
        $credentials = [
            "email" => "alvarado4@unmsm.edu.pe",
            "password" => "perrovaca",
        ];
        $this->post('login', $credentials);

        $view = $this->get(route('perfil',auth()->user()->id))->assertStatus(200);

        //$view = $this->view('perfil', compaq(auth()->user()->id));

        $view->assertSee('Frank');
    }


    public function test_errorValidationUpdate_DNIdiferent()
    {
        //$this->withoutExceptionHandling();
        $name = 'Frank';
        $lastname = 'Alvarado Pardo';
        $dni = '709009224';
        $email = 'alvarado4@unmsm.edu.pe';
        $birthdate = '2021-07-11 23:47:47';
        $password = 'perrovaca';

        $credentials = [
            "email" => "alvarado4@unmsm.edu.pe",
            "password" => "perrovaca",
        ];
        $this->post('login', $credentials);

        $view = $this->get(route('perfil',auth()->user()->id))->assertStatus(200);

        $response = $this->from('/perfil/7')->patch(route('update.user',auth()->user()->id), ['name'=>$name, 
                                                                                  'lastname'=>$lastname, 
                                                                                  'dni'=>$dni, 
                                                                                  'email'=>$email, 
                                                                                  'birthdate'=>$birthdate, 
                                                                                  'password'=>$password, 
                                                                                  'password_confirmation'=>$password]
                                )->assertRedirect('/perfil/7');

        $view = $this->get(route('perfil',auth()->user()->id))->assertStatus(200);
              
        $view->assertSessionDoesntHaveErrors(['dni']);

    }

    public function test_errorValidationUpdate_EMAILdiferent()
    {
        //$this->withoutExceptionHandling();
        $name = 'Frank';
        $lastname = 'Alvarado Pardo';
        $dni = '70900925';
        $email = 'mantecoso@gmail.com';
        $birthdate = '2021-07-11 23:47:47';
        $password = 'perrovaca';

        $credentials = [
            "email" => "alvarado4@unmsm.edu.pe",
            "password" => "perrovaca",
        ];
        $this->post('login', $credentials);

        $response = $this->from('/perfil/7')->patch(route('update.user',auth()->user()->id), ['name'=>$name, 
                                                                                  'lastname'=>$lastname, 
                                                                                  'dni'=>$dni, 
                                                                                  'email'=>$email, 
                                                                                  'birthdate'=>$birthdate, 
                                                                                  'password'=>$password, 
                                                                                  'password_confirmation'=>$password]
                                )->assertRedirect('/perfil/7');

        $view = $this->get(route('perfil',auth()->user()->id))->assertStatus(200);
              
        $view->assertSessionDoesntHaveErrors(['email']);
        
    }


    public function test_errorValidationUpdate_data()
    {
        //$this->withoutExceptionHandling();
        $name = 'Frank';
        $lastname = 'Alvarado Pardo';
        $dni = '70900925';
        $email = 'alvarado4@unmsm.edu.pe';
        $birthdate = '2021-07-11 23:47:47';
        $password = 'perrovaca';

        $credentials = [
            "email" => "alvarado4@unmsm.edu.pe",
            "password" => "perrovaca",
        ];
        $this->post('login', $credentials);

        $response = $this->from('/perfil/7')->patch(route('update.user',auth()->user()->id), ['name'=>$name, 
                                                                                  'lastname'=>$lastname, 
                                                                                  'dni'=>$dni, 
                                                                                  'email'=>$email, 
                                                                                  'birthdate'=>$birthdate, 
                                                                                  'password'=>$password, 
                                                                                  'password_confirmation'=>$password]
                                )->assertRedirect('/perfil/7');
        
        $this->assertContains('Realizado correctamente',[$response->getSession()->get('updateMessage')]);
        $this->assertContains(302,[$response->getStatusCode()]);
 
    }

    public function test_baseCreateUpdate_validation()
    {
        $name = 'Frank';
        $lastname = 'Alvarado Pardo';
        $dni = '70900925';
        $email = 'alvarado4@unmsm.edu.pe';
        $birthdate = '2021-07-11 23:47:47';
        $password = 'perrovaca';
        //$password = '959146547';
        //$password_confirmation = '959146547';

        $response = $this->assertDatabaseHas('users', [
            'name'=>$name, 
            'lastname'=>$lastname, 
            'dni'=>$dni, 
            'email'=>$email, 
            'birthdate'=>$birthdate, 
            //'password'=>bcrypt($password), 
            //'password_confirmation'=>bcrypt($password)
        ]);
    }
}

