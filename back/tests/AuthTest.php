<?php

class AuthTest extends TestCase {

	/**
	 * @return void
	 */
	public function testAccesDenied()
	{
		$response = $this->call('GET', '/');

		$this->assertEquals(302, $response->getStatusCode());
	}

	/**
	 * @return void
	 */
	public function testAuthInvalidCredentials ()
	{
		$response = $this->call('POST', '/auth/login', [
			'_token' => csrf_token(),
			'email' => 'notemail',
			'password' => 'password',
		]);

		$this->assertEquals($this->app['session']->get('errors')->keys(), ['email']);


		$response = $this->call('POST', '/auth/login', [
			'_token' => csrf_token(),
			'email' => 'admin@ideil.com',
			'password' => 'wrongpassword',
		]);

		$this->assertEquals($this->app['session']->get('errors')->keys(), ['email']);


		$response = $this->call('POST', '/auth/login', [
			'_token' => csrf_token(),
			'email' => '',
			'password' => 'wrongpassword',
		]);

		$this->assertEquals($this->app['session']->get('errors')->keys(), ['email']);


		$response = $this->call('POST', '/auth/login', [
			'_token' => csrf_token(),
			'email' => 'admin@ideil.com',
			'password' => '',
		]);

		$this->assertEquals($this->app['session']->get('errors')->keys(), ['password']);
	}

	/**
	 * @return void
	 */
	public function testAuthValidCredentials ()
	{
		$response = $this->call('POST', '/auth/login', [
			'_token' => csrf_token(),
			'email' => 'admin@ideil.com',
			'password' => 'restore1100',
		]);

		$this->assertNull($this->app['session']->get('errors'));

		$this->assertEquals(302, $response->getStatusCode());
	}

}
