<?php namespace Flarum\Tags;

use Flarum\Api\Serializers\Serializer;

class TagSerializer extends Serializer
{
    protected $type = 'tags';

    protected function getDefaultAttributes($tag)
    {
        return [
            'name'               => $tag->name,
            'description'        => $tag->description,
            'slug'               => $tag->slug,
            'color'              => $tag->color,
            'backgroundUrl'      => $tag->background_path,
            'backgroundMode'     => $tag->background_mode,
            'iconUrl'            => $tag->icon_path,
            'discussionsCount'   => (int) $tag->discussions_count,
            'position'           => $tag->position === null ? null : (int) $tag->position,
            'defaultSort'        => $tag->default_sort,
            'isChild'            => (bool) $tag->parent_id,
            'lastTime'           => $tag->last_time ? $tag->last_time->toRFC3339String() : null,
            'canStartDiscussion' => $tag->can($this->actor, 'startDiscussion')
        ];
    }

    protected function parent()
    {
        return $this->hasOne('Flarum\Tags\TagSerializer');
    }

    protected function lastDiscussion()
    {
        return $this->hasOne('Flarum\Api\Serializers\DiscussionSerializer');
    }
}
