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

    public function search($search)
    {
        $formattedSearch = preg_split('/\s+/', $search, -1, PREG_SPLIT_NO_EMPTY);

        $values =  CommunityLink::where(function ($q) use ($formattedSearch) {
            foreach ($formattedSearch as $value) {
                $q->orWhere('title', 'like', "%{$value}%")->where('approved', true);
            }
        })->paginate(3);

        return $values;
    }

    public function searchAndPopular($search)
    {

        $formattedSearch = preg_split('/\s+/', $search, -1, PREG_SPLIT_NO_EMPTY);

        $values = CommunityLink::withCount('users')->where(function ($q) use ($formattedSearch) {
            foreach ($formattedSearch as $value) {
                $q->orWhere('title', 'like', "%{$value}%");
            }
        })->orderBy('users_count', 'desc')->where('approved', true)->paginate(3);


        return $values;
    }
}
