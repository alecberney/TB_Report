<?php

    [...]

    /**
     * Get the currently authenticated user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user()
    {
        if (is_null($this->user)) {
            return null;
        }

        return $this->user;
    }

    /**
     * Get the ID for the currently authenticated user.
     *
     * @return int|null
     */
    public function id()
    {
        if ($user = $this->user()) {
            return $this->user()->id;
        }
    }

    /**
     * Validate a user's credentials.
     *
     * @param  array  $credentials
     * @return bool
     */
    public function validate(array $credentials = []): bool
    {
        if (!$this->decodedToken) {
            return false;
        }

        // Load user from BD
        $user = $this->provider->retrieveByCredentials($credentials);

        if (!$user) {
            // Create user in BD if not exists
            log::Info("User not found. create a new one with credentials: " . json_encode($credentials));
            $user = User::create([
                'username' => $this->decodedToken->preferred_username,
                'name' => $this->decodedToken->given_name,
                'surname' => $this->decodedToken->family_name,
                'email' => $this->decodedToken->email,
            ]);

            // Add client role by default
            $user->roles()->attach(Role::where('name', Roles::CLIENT)->first()->id);
            $user->save();
        }

        $this->setUser($user);

        return true;
    }

    [...]