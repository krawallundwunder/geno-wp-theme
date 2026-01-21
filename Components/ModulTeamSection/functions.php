<?php

namespace Flynt\Components\ModulTeamSection;

add_filter('Flynt/addComponentData?name=ModulTeamSection', function ($data) {
  $groupedMembers = [];

  // 1. Get all ungrouped team members (no taxonomy assigned)
  $ungroupedArgs = [
    'post_type' => 'team_member',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'tax_query' => [
      [
        'taxonomy' => 'team_group',
        'operator' => 'NOT EXISTS',
      ]
    ],
    'meta_query' => [
      [
        'key' => 'team_member_is_shown',
        'value' => '1',
        'compare' => '=='
      ]
    ]
  ];

  $ungroupedMembers = get_posts($ungroupedArgs);

  if (!empty($ungroupedMembers)) {
    foreach ($ungroupedMembers as $member) {
      $member->fields = get_fields($member->ID);
    }
    $groupedMembers[] = [
      'title' => '', // No title for ungrouped
      'members' => $ungroupedMembers,
      'is_ungrouped' => true
    ];
  }

  // 2. Get grouped team members by taxonomy terms
  $terms = get_terms([
    'taxonomy' => 'team_group',
    'hide_empty' => true,
  ]);

  if (!empty($terms) && !is_wp_error($terms)) {
    foreach ($terms as $term) {
      $args = [
        'post_type' => 'team_member',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'tax_query' => [
          [
            'taxonomy' => 'team_group',
            'field' => 'term_id',
            'terms' => $term->term_id,
          ]
        ],
        'meta_query' => [
          [
            'key' => 'team_member_is_shown',
            'value' => '1',
            'compare' => '=='
          ]
        ]
      ];

      $members = get_posts($args);

      if (!empty($members)) {
        foreach ($members as $member) {
          $member->fields = get_fields($member->ID);
        }
        $groupedMembers[] = [
          'title' => $term->name,
          'members' => $members,
          'is_ungrouped' => false
        ];
      }
    }
  }

  $data['groupedMembers'] = $groupedMembers;
  return $data;
});

function getACFLayout()
{
  return [
    'name' => 'modulTeamSection',
    'label' => 'Modul: Team Bereich',
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
        'label' => __('Beschreibung', 'flynt'),
        'name' => 'description',
        'type' => 'wysiwyg',
        'delay' => 0,
        'media_upload' => 0,
        'instructions' => __('Textinhalt des Blocks.', 'flynt'),
      ],
    ],
  ];
}
