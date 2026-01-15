<?php

namespace Flynt\Components\ModulTeamSection;


add_filter('Flynt/addComponentData?name=ModulTeamSection', function ($data) {
  $args = [
    'post_type' => 'team_member',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'meta_query' => [
      [
        'key' => 'team_member_is_shown',
        'value' => '1',
        'compare' => '=='
      ]
    ]
  ];

  $teamMembers = get_posts($args);

  if (!empty($teamMembers)) {
    $memberIds = wp_list_pluck($teamMembers, 'ID');
    update_postmeta_cache($memberIds);

    foreach ($teamMembers as $member) {
      $member->fields = get_fields($member->ID);
    }
  }

  $data['teamMembers'] = $teamMembers;

  return $data;
});

function getACFLayout()
{
  return [
    'name' => 'modulTeamSection',
    'label' => 'Modul: Team Section',
    'sub_fields' => [
      [
        'label' => 'Überschrift',
        'name' => 'headingTab',
        'type' => 'tab',
      ],
      [
        'label' => __('Tag', 'flynt'),
        'name' => 'tag',
        'type' => 'text',
        'instructions' => __('Optionaler Tag über dem Titel.', 'flynt'),
      ],
      [
        'label' => __('Titel', 'flynt'),
        'name' => 'title',
        'type' => 'text',
        'instructions' => __('Hauptüberschrift des Blocks.', 'flynt'),
      ],
      [
        'label' => __('Fließtext', 'flynt'),
        'name' => 'description',
        'type' => 'wysiwyg',
        'delay' => 0,
        'media_upload' => 0,
        'instructions' => __('Textinhalt des Blocks.', 'flynt'),
      ],
    ],
  ];
}
