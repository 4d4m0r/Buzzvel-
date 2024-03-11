<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Models\Vacation;
use Database\Factories\VacationFactory;

class VacationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function create_vacation()
    {
        $data = [
            'title' => 'Vacation Title Test',
            'description' => 'Vacation Description Test',
            'date' => '2024-12-25',
            'location' => 'Vacation Location Test',
        ];

        $vacation = VacationFactory::new()->create($data);

        $response = $this->postJson('/api/vacation', $data);

        $response->assertStatus(201)
            ->assertJson($data);

        $this->assertDatabaseHas('vacations', $data);
    }

    /** @test */
    public function show_vacation()
    {
        $vacation = VacationFactory::new()->create();

        $response = $this->getJson('/api/vacation/' . $vacation->id);

        $response->assertStatus(200)
            ->assertJson($vacation->toArray());
    }

    /** @test */
    public function delete_vacation()
    {
       $vacation = VacationFactory::new()->create();

        $response = $this->deleteJson('/api/vacation/' . $vacation->id);

        $response->assertStatus(200);

        $this->assertDatabaseMissing('vacations', ['id' => $vacation->id]);
    }

    /** @test */
    public function update_vacation()
    {
        $vacation = VacationFactory::new()->create();

        $updateData = [
            'title' => 'Vacation Title Updated',
            'description' => 'Vacation Description Updated',
            'date' => '2025-01-01',
            'location' => 'Vacation Location Updated',
        ];

        $response = $this->putJson('/api/vacation/' . $vacation->id, $updateData);
        $response->assertStatus(200);
        $response->assertJson($updateData);

        $this->assertDatabaseHas('vacations', $updateData);
        $this->assertDatabaseMissing('vacations', $vacation->toArray());
    }
}
