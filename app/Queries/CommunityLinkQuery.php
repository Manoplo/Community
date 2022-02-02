<?php


namespace App\Queries;

use App\Models\Channel;
use App\Models\CommunityLink;

class CommunityLinkQuery
{
    public function getByChannel(Channel $channel)
    {
        return $channel->communityLinks()->where('approved', true)->latest()->paginate(3);
    }

    public function getMostPopularByChannel(Channel $channel)
    {
        return $channel->communityLinks()->withCount('users')->where('approved', true)->orderBy('users_count', 'desc')->paginate(3);
    }

    public function getAll()
    {
        return CommunityLink::where('approved', true)->latest()->paginate(3);
    }

    public function getMostPopular()
    {
        return CommunityLink::withCount('users')->orderBy('users_count', 'desc')->where('approved', true)->paginate(3);
    }
}
