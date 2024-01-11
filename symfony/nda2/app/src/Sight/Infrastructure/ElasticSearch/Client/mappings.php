<?php
return [
    "properties" => [
        "address"                => [
            "properties" => [
                "address" => [
                    "type"   => "text",
                    "fields" => [
                        "keyword" => [
                            "ignore_above" => 256,
                            "type"         => "keyword",
                        ],
                    ],
                ],
                "id"      => [
                    "type" => "long",
                ],
            ],
            "enabled"    => false,
        ],
        "code"                   => [
            "type"   => "text",
            "fields" => [
                "keyword" => [
                    "ignore_above" => 256,
                    "type"         => "keyword",
                ],
            ],
            "index"  => false,
        ],
        "preview_image"          => [
            "properties" => [
                "ext"        => [
                    "type"   => "text",
                    "fields" => [
                        "keyword" => [
                            "ignore_above" => 256,
                            "type"         => "keyword",
                        ],
                    ],
                ],
                "formats"    => [
                    "properties" => [
                        "small"     => [
                            "properties" => [
                                "ext"    => [
                                    "type"   => "text",
                                    "fields" => [
                                        "keyword" => [
                                            "ignore_above" => 256,
                                            "type"         => "keyword",
                                        ],
                                    ],
                                ],
                                "size"   => [
                                    "type" => "float",
                                ],
                                "mime"   => [
                                    "type"   => "text",
                                    "fields" => [
                                        "keyword" => [
                                            "ignore_above" => 256,
                                            "type"         => "keyword",
                                        ],
                                    ],
                                ],
                                "name"   => [
                                    "type"   => "text",
                                    "fields" => [
                                        "keyword" => [
                                            "ignore_above" => 256,
                                            "type"         => "keyword",
                                        ],
                                    ],
                                ],
                                "width"  => [
                                    "type" => "long",
                                ],
                                "hash"   => [
                                    "type"   => "text",
                                    "fields" => [
                                        "keyword" => [
                                            "ignore_above" => 256,
                                            "type"         => "keyword",
                                        ],
                                    ],
                                ],
                                "url"    => [
                                    "type" => "text",
                                ],
                                "height" => [
                                    "type" => "long",
                                ],
                            ],
                        ],
                        "thumbnail" => [
                            "properties" => [
                                "ext"    => [
                                    "type"   => "text",
                                    "fields" => [
                                        "keyword" => [
                                            "ignore_above" => 256,
                                            "type"         => "keyword",
                                        ],
                                    ],
                                ],
                                "size"   => [
                                    "type" => "float",
                                ],
                                "mime"   => [
                                    "type"   => "text",
                                    "fields" => [
                                        "keyword" => [
                                            "ignore_above" => 256,
                                            "type"         => "keyword",
                                        ],
                                    ],
                                ],
                                "name"   => [
                                    "type"   => "text",
                                    "fields" => [
                                        "keyword" => [
                                            "ignore_above" => 256,
                                            "type"         => "keyword",
                                        ],
                                    ],
                                ],
                                "width"  => [
                                    "type" => "long",
                                ],
                                "hash"   => [
                                    "type"   => "text",
                                    "fields" => [
                                        "keyword" => [
                                            "ignore_above" => 256,
                                            "type"         => "keyword",
                                        ],
                                    ],
                                ],
                                "url"    => [
                                    "type"   => "text",
                                    "fields" => [
                                        "keyword" => [
                                            "ignore_above" => 256,
                                            "type"         => "keyword",
                                        ],
                                    ],
                                ],
                                "height" => [
                                    "type" => "long",
                                ],
                            ],
                        ],
                        "large"     => [
                            "properties" => [
                                "ext"    => [
                                    "type"   => "text",
                                    "fields" => [
                                        "keyword" => [
                                            "ignore_above" => 256,
                                            "type"         => "keyword",
                                        ],
                                    ],
                                ],
                                "size"   => [
                                    "type" => "float",
                                ],
                                "mime"   => [
                                    "type"   => "text",
                                    "fields" => [
                                        "keyword" => [
                                            "ignore_above" => 256,
                                            "type"         => "keyword",
                                        ],
                                    ],
                                ],
                                "name"   => [
                                    "type"   => "text",
                                    "fields" => [
                                        "keyword" => [
                                            "ignore_above" => 256,
                                            "type"         => "keyword",
                                        ],
                                    ],
                                ],
                                "width"  => [
                                    "type" => "long",
                                ],
                                "hash"   => [
                                    "type"   => "text",
                                    "fields" => [
                                        "keyword" => [
                                            "ignore_above" => 256,
                                            "type"         => "keyword",
                                        ],
                                    ],
                                ],
                                "url"    => [
                                    "type" => "text",
                                ],
                                "height" => [
                                    "type" => "long",
                                ],
                            ],
                        ],
                        "medium"    => [
                            "properties" => [
                                "ext"    => [
                                    "type"   => "text",
                                    "fields" => [
                                        "keyword" => [
                                            "ignore_above" => 256,
                                            "type"         => "keyword",
                                        ],
                                    ],
                                ],
                                "size"   => [
                                    "type" => "float",
                                ],
                                "mime"   => [
                                    "type"   => "text",
                                    "fields" => [
                                        "keyword" => [
                                            "ignore_above" => 256,
                                            "type"         => "keyword",
                                        ],
                                    ],
                                ],
                                "name"   => [
                                    "type"   => "text",
                                    "fields" => [
                                        "keyword" => [
                                            "ignore_above" => 256,
                                            "type"         => "keyword",
                                        ],
                                    ],
                                ],
                                "width"  => [
                                    "type" => "long",
                                ],
                                "hash"   => [
                                    "type"   => "text",
                                    "fields" => [
                                        "keyword" => [
                                            "ignore_above" => 256,
                                            "type"         => "keyword",
                                        ],
                                    ],
                                ],
                                "url"    => [
                                    "type" => "text",
                                ],
                                "height" => [
                                    "type" => "long",
                                ],
                            ],
                        ],
                    ],
                ],
                "mime"       => [
                    "type"   => "text",
                    "fields" => [
                        "keyword" => [
                            "ignore_above" => 256,
                            "type"         => "keyword",
                        ],
                    ],
                ],
                "url"        => [
                    "type"   => "text",
                    "fields" => [
                        "keyword" => [
                            "ignore_above" => 256,
                            "type"         => "keyword",
                        ],
                    ],
                ],
                "folderPath" => [
                    "type"   => "text",
                    "fields" => [
                        "keyword" => [
                            "ignore_above" => 256,
                            "type"         => "keyword",
                        ],
                    ],
                ],
                "createdAt"  => [
                    "type" => "date",
                ],
                "size"       => [
                    "type" => "float",
                ],
                "provider"   => [
                    "type"   => "text",
                    "fields" => [
                        "keyword" => [
                            "ignore_above" => 256,
                            "type"         => "keyword",
                        ],
                    ],
                ],
                "name"       => [
                    "type"   => "text",
                    "fields" => [
                        "keyword" => [
                            "ignore_above" => 256,
                            "type"         => "keyword",
                        ],
                    ],
                ],
                "width"      => [
                    "type" => "long",
                ],
                "id"         => [
                    "type" => "long",
                ],
                "hash"       => [
                    "type"   => "text",
                    "fields" => [
                        "keyword" => [
                            "ignore_above" => 256,
                            "type"         => "keyword",
                        ],
                    ],
                ],
                "height"     => [
                    "type" => "long",
                ],
                "updatedAt"  => [
                    "type" => "date",
                ],
            ],
            "enabled"    => false,
        ],
        "coordinates"            => [
            "type"   => "text",
            "fields" => [
                "keyword" => [
                    "ignore_above" => 256,
                    "type"         => "keyword",
                ],
            ],
            "index"  => false,
        ],
        "active"                 => [
            "type"  => "boolean",
            "index" => false,
        ],
        "description"            => [
            "type"   => "text",
            "fields" => [
                "keyword" => [
                    "ignore_above" => 256,
                    "type"         => "keyword",
                ],
            ],
            "index"  => false,
        ],
        "how_to_find"            => [
            "type"   => "text",
            "fields" => [
                "keyword" => [
                    "ignore_above" => 256,
                    "type"         => "keyword",
                ],
            ],
            "index"  => false,
        ],
        "detail_image"           => [
            "properties" => [
                "ext"        => [
                    "type"   => "text",
                    "fields" => [
                        "keyword" => [
                            "ignore_above" => 256,
                            "type"         => "keyword",
                        ],
                    ],
                ],
                "formats"    => [
                    "properties" => [
                        "small"     => [
                            "properties" => [
                                "ext"    => [
                                    "type"   => "text",
                                    "fields" => [
                                        "keyword" => [
                                            "ignore_above" => 256,
                                            "type"         => "keyword",
                                        ],
                                    ],
                                ],
                                "size"   => [
                                    "type" => "float",
                                ],
                                "mime"   => [
                                    "type"   => "text",
                                    "fields" => [
                                        "keyword" => [
                                            "ignore_above" => 256,
                                            "type"         => "keyword",
                                        ],
                                    ],
                                ],
                                "name"   => [
                                    "type"   => "text",
                                    "fields" => [
                                        "keyword" => [
                                            "ignore_above" => 256,
                                            "type"         => "keyword",
                                        ],
                                    ],
                                ],
                                "width"  => [
                                    "type" => "long",
                                ],
                                "hash"   => [
                                    "type"   => "text",
                                    "fields" => [
                                        "keyword" => [
                                            "ignore_above" => 256,
                                            "type"         => "keyword",
                                        ],
                                    ],
                                ],
                                "url"    => [
                                    "type" => "text",
                                ],
                                "height" => [
                                    "type" => "long",
                                ],
                            ],
                        ],
                        "thumbnail" => [
                            "properties" => [
                                "ext"    => [
                                    "type"   => "text",
                                    "fields" => [
                                        "keyword" => [
                                            "ignore_above" => 256,
                                            "type"         => "keyword",
                                        ],
                                    ],
                                ],
                                "size"   => [
                                    "type" => "float",
                                ],
                                "mime"   => [
                                    "type"   => "text",
                                    "fields" => [
                                        "keyword" => [
                                            "ignore_above" => 256,
                                            "type"         => "keyword",
                                        ],
                                    ],
                                ],
                                "name"   => [
                                    "type"   => "text",
                                    "fields" => [
                                        "keyword" => [
                                            "ignore_above" => 256,
                                            "type"         => "keyword",
                                        ],
                                    ],
                                ],
                                "width"  => [
                                    "type" => "long",
                                ],
                                "hash"   => [
                                    "type"   => "text",
                                    "fields" => [
                                        "keyword" => [
                                            "ignore_above" => 256,
                                            "type"         => "keyword",
                                        ],
                                    ],
                                ],
                                "url"    => [
                                    "type" => "text",
                                ],
                                "height" => [
                                    "type" => "long",
                                ],
                            ],
                        ],
                        "medium"    => [
                            "properties" => [
                                "ext"    => [
                                    "type"   => "text",
                                    "fields" => [
                                        "keyword" => [
                                            "ignore_above" => 256,
                                            "type"         => "keyword",
                                        ],
                                    ],
                                ],
                                "size"   => [
                                    "type" => "float",
                                ],
                                "mime"   => [
                                    "type"   => "text",
                                    "fields" => [
                                        "keyword" => [
                                            "ignore_above" => 256,
                                            "type"         => "keyword",
                                        ],
                                    ],
                                ],
                                "name"   => [
                                    "type"   => "text",
                                    "fields" => [
                                        "keyword" => [
                                            "ignore_above" => 256,
                                            "type"         => "keyword",
                                        ],
                                    ],
                                ],
                                "width"  => [
                                    "type" => "long",
                                ],
                                "hash"   => [
                                    "type"   => "text",
                                    "fields" => [
                                        "keyword" => [
                                            "ignore_above" => 256,
                                            "type"         => "keyword",
                                        ],
                                    ],
                                ],
                                "url"    => [
                                    "type" => "text",
                                ],
                                "height" => [
                                    "type" => "long",
                                ],
                            ],
                        ],
                    ],
                ],
                "mime"       => [
                    "type"   => "text",
                    "fields" => [
                        "keyword" => [
                            "ignore_above" => 256,
                            "type"         => "keyword",
                        ],
                    ],
                ],
                "url"        => [
                    "type"   => "text",
                    "fields" => [
                        "keyword" => [
                            "ignore_above" => 256,
                            "type"         => "keyword",
                        ],
                    ],
                ],
                "folderPath" => [
                    "type"   => "text",
                    "fields" => [
                        "keyword" => [
                            "ignore_above" => 256,
                            "type"         => "keyword",
                        ],
                    ],
                ],
                "createdAt"  => [
                    "type" => "date",
                ],
                "size"       => [
                    "type" => "float",
                ],
                "provider"   => [
                    "type"   => "text",
                    "fields" => [
                        "keyword" => [
                            "ignore_above" => 256,
                            "type"         => "keyword",
                        ],
                    ],
                ],
                "name"       => [
                    "type"   => "text",
                    "fields" => [
                        "keyword" => [
                            "ignore_above" => 256,
                            "type"         => "keyword",
                        ],
                    ],
                ],
                "width"      => [
                    "type" => "long",
                ],
                "id"         => [
                    "type" => "long",
                ],
                "hash"       => [
                    "type"   => "text",
                    "fields" => [
                        "keyword" => [
                            "ignore_above" => 256,
                            "type"         => "keyword",
                        ],
                    ],
                ],
                "height"     => [
                    "type" => "long",
                ],
                "updatedAt"  => [
                    "type" => "date",
                ],
            ],
            "enabled"    => false,
        ],
        "check"                  => [
            "type"   => "text",
            "fields" => [
                "keyword" => [
                    "ignore_above" => 256,
                    "type"         => "keyword",
                ],
            ],
            "index"  => false,
        ],
        "services"               => [
            "properties" => [
                "createdAt" => [
                    "type" => "date",
                ],
                "link"      => [
                    "type"   => "text",
                    "fields" => [
                        "keyword" => [
                            "ignore_above" => 256,
                            "type"         => "keyword",
                        ],
                    ],
                ],
                "name"      => [
                    "type"   => "text",
                    "fields" => [
                        "keyword" => [
                            "ignore_above" => 256,
                            "type"         => "keyword",
                        ],
                    ],
                ],
                "id"        => [
                    "type" => "long",
                ],
                "updatedAt" => [
                    "type" => "date",
                ],
            ],
            "enabled"    => false,
        ],
        "sort"                   => [
            "type"  => "long",
            "index" => false,
        ],
        "uuid"                   => [
            "type"   => "text",
            "fields" => [
                "keyword" => [
                    "ignore_above" => 256,
                    "type"         => "keyword",
                ],
            ],
            "index"  => false,
        ],
        "settlement"             => [
            "properties" => [
                "createdAt"   => [
                    "type" => "date",
                ],
                "code"        => [
                    "type"   => "text",
                    "fields" => [
                        "keyword" => [
                            "ignore_above" => 256,
                            "type"         => "keyword",
                        ],
                    ],
                ],
                "coordinates" => [
                    "type"   => "text",
                    "fields" => [
                        "keyword" => [
                            "ignore_above" => 256,
                            "type"         => "keyword",
                        ],
                    ],
                ],
                "name"        => [
                    "type"   => "text",
                    "fields" => [
                        "keyword" => [
                            "ignore_above" => 256,
                            "type"         => "keyword",
                        ],
                    ],
                ],
                "id"          => [
                    "type" => "long",
                ],
                "updatedAt"   => [
                    "type" => "date",
                ],
            ],
            "enabled"    => false,
        ],
        "createdAt"              => [
            "type"  => "date",
            "index" => false,
        ],
        "site"                   => [
            "type"   => "text",
            "fields" => [
                "keyword" => [
                    "ignore_above" => 256,
                    "type"         => "keyword",
                ],
            ],
            "index"  => false,
        ],
        "check_info"             => [
            "type"   => "text",
            "fields" => [
                "keyword" => [
                    "ignore_above" => 256,
                    "type"         => "keyword",
                ],
            ],
            "index"  => false,
        ],
        "phone"                  => [
            "properties" => [
                "phone" => [
                    "type"   => "text",
                    "fields" => [
                        "keyword" => [
                            "ignore_above" => 256,
                            "type"         => "keyword",
                        ],
                    ],
                ],
                "id"    => [
                    "type" => "long",
                ],
            ],
            "enabled"    => false,
        ],
        "name"                   => [
            "type"   => "text",
            "fields" => [
                "keyword" => [
                    "ignore_above" => 256,
                    "type"         => "keyword",
                ],
            ],
            "index"  => false,
        ],
        "id"                     => [
            "type"  => "long",
            "index" => false,
        ],
        "kitchen"                => [
            "properties" => [
                "createdAt" => [
                    "type" => "date",
                ],
                "link"      => [
                    "type"   => "text",
                    "fields" => [
                        "keyword" => [
                            "ignore_above" => 256,
                            "type"         => "keyword",
                        ],
                    ],
                ],
                "name"      => [
                    "type"   => "text",
                    "fields" => [
                        "keyword" => [
                            "ignore_above" => 256,
                            "type"         => "keyword",
                        ],
                    ],
                ],
                "id"        => [
                    "type" => "long",
                ],
                "updatedAt" => [
                    "type" => "date",
                ],
            ],
            "enabled"    => false,
        ],
        "seo"                    => [
            "properties" => [
                "seo_description" => [
                    "type" => "text",
                ],
                "id"              => [
                    "type" => "long",
                ],
                "seo_title"       => [
                    "type"   => "text",
                    "fields" => [
                        "keyword" => [
                            "ignore_above" => 256,
                            "type"         => "keyword",
                        ],
                    ],
                ],
                "seo_keywords"    => [
                    "type"   => "text",
                    "fields" => [
                        "keyword" => [
                            "ignore_above" => 256,
                            "type"         => "keyword",
                        ],
                    ],
                ],
            ],
            "enabled"    => false,
        ],
        "email"                  => [
            "properties" => [
                "id"    => [
                    "type" => "long",
                ],
                "email" => [
                    "type"   => "text",
                    "fields" => [
                        "keyword" => [
                            "ignore_above" => 256,
                            "type"         => "keyword",
                        ],
                    ],
                ],
            ],
            "enabled"    => false,
        ],
        "updatedAt"              => [
            "type"  => "date",
            "index" => false,
        ],
        "search_data"            => [
            "type"       => "nested",
            "properties" => [
                "keyword_facet" => [
                    "type"       => "nested",
                    "properties" => [
                        "facet_code"  => [
                            "type"  => "keyword",
                            "index" => true,
                        ],
                        "facet_value" => [
                            "type"  => "keyword",
                            "index" => true,
                        ],
                    ],
                ],
                "number_facet"  => [
                    "type"       => "nested",
                    "properties" => [
                        "facet_code"  => [
                            "type"  => "keyword",
                            "index" => true,
                        ],
                        "facet_value" => [
                            "type" => "double",
                        ],
                    ],
                ],
            ],
        ],
        "full_search_content"    => [
            "type" => "text",
        ],
        "suggest_search_content" => [
            "type"            => "text",
            "analyzer"        => "autocomplete",
            "search_analyzer" => "standard",
        ],
    ],
];