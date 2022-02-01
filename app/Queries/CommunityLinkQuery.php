<?php


namespace App\Queries;

use App\Models\Channel;
use App\Models\CommunityLink;

class CommunityLinkQuery
{
    public static function getByChannel(Channel $channel)
    {
        return $channel->communityLinks()->where('approved', true)->latest()->paginate(3);
    }

    public static function getAll()
    {
        return CommunityLink::where('approved', true)->latest()->paginate(3);
    }

    public static function getMostPopular()
    {
        return CommunityLink::withCount('users')->orderBy('users_count', 'desc')->where('approved', true)->paginate(3);
    }
}
