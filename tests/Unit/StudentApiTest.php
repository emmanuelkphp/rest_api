<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\Student;



class StudentApiTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_create_student(){
        $response = $this->postJson('/api/students/create', [
            'name' => 'Rahul Kumar',
            'course' => 'BTech',
            'email' => 'rahul@gmail.com',
            'phone' => '7485961425'
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('students', ['name' => 'Rahul Kumar']);
    }

    public function test_read_student(){
        $student = Student::create([
            'name' => 'Kamir Rick',
            'course' => 'MCA',
            'email' => 'rio@gmail.com',
            'phone' => '3625147894'
        ]);
        $response = $this->getJson('/api/students/'.$student->id);
        $response->assertStatus(200);
        $response->assertJson(['student' => ['name' => $student->name]]);
    }

    public function test_update_student(){
        
    }
}
