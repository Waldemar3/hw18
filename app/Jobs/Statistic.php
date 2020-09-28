<?php

namespace App\Jobs;

use App\Link;
use App\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Statistic implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Link
     */
    private $link;
    /**
     * @var Authenticatable
     */
    private $user;

    private $ip;
    private $user_agent;

    /**
     * Create a new job instance.
     *
     * @param Link $link
     * @param Authenticatable $user
     * @param string $ip
     * @param string $user_agent
     */
    public function __construct(Link $link, Authenticatable $user, string $ip, string $user_agent)
    {
        $this->link = $link;
        $this->user = $user;
        $this->ip = $ip;
        $this->user_agent = $user_agent;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->link->number_of_transitions += 1;
        $this->user->link()->save($this->link);

        $stat = new \App\Statistic();
        $stat->ip = $this->ip;
        $stat->user_agent = $this->user_agent;
        $this->link->statistic()->save($stat);

    }
}
