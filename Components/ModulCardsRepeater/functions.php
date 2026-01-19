<?php

namespace Flynt\Components\ModulCardsRepeater;

add_filter('Flynt/addComponentData?name=ModulCardsRepeater', function ($data) {
  // Format CTA buttons
  if (!empty($data['ctaButtons'])) {
    $data['buttons'] = array_map(fn($btn) => [
      'text' => $btn['button']['title'] ?? '',
      'link' => $btn['button']['url'] ?? '',
    ], array_filter($data['ctaButtons'], fn($btn) => !empty($btn['button'])));
  }

  return $data;
});

function getACFLayout()
{
  return [
    'name' => 'ModulCardsRepeater',
    'label' => 'Modul: Cards Repeater',
    'sub_fields' => [
      [
        'label' => __('Inhalt', 'flynt'),
        'name' => 'contentTab',
        'type' => 'tab',
        'placement' => 'top',
      ],
      ['label' => 'Tag', 'name' => 'tag', 'type' => 'text', 'maxlength' => 50],
      ['label' => 'Titel', 'name' => 'title', 'type' => 'text'],
      ['label' => 'Beschreibung', 'name' => 'description', 'type' => 'wysiwyg', 'media_upload' => 0],
      [
        'label' => 'CTA Buttons',
        'name' => 'ctaButtons',
        'type' => 'repeater',
        'layout' => 'row',
        'button_label' => 'Button Hinzufügen',
        'sub_fields' => [
          ['label' => 'Button', 'name' => 'button', 'type' => 'link', 'return_format' => 'array'],
        ],
      ],
      [
        'label' => 'Cards',
        'name' => 'cards',
        'type' => 'repeater',
        'min' => 1,
        'layout' => 'block',
        'button_label' => 'Card hinzufügen',
        'sub_fields' => [
          ['label' => 'Bild', 'name' => 'image', 'type' => 'image', 'return_format' => 'id', 'preview_size' => 'medium'],
          ['label' => 'Titel', 'name' => 'title', 'type' => 'text'],
          ['label' => 'Beschreibung', 'name' => 'description', 'type' => 'wysiwyg', 'media_upload' => 0],
          ['label' => 'Button Link', 'name' => 'cardButton', 'type' => 'link', 'return_format' => 'array'],
        ],
      ],
      [
        'label' => __('Einstellungen', 'flynt'),
        'name' => 'settingsTab',
        'type' => 'tab',
        'placement' => 'top',
      ],
      [
        'label' => 'Text Ausrichtung',
        'name' => 'textAlign',
        'type' => 'button_group',
        'choices' => [
          'text-start' => __('Links', 'flynt'),
          'text-center' => __('Zentriert', 'flynt'),
        ],
        'default_value' => 'text-start',
        'allow_null' => 0,
        'return_format' => 'value',
        'layout' => 'horizontal',
      ],
    ],
  ];
}
