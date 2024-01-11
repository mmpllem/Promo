<?php
return [
    "index" => [
        "analysis" => [
            "char_filter" => [
                "eCharFilter" => [
                    "type"     => "mapping",
                    "mappings" => [
                        ", => .",
                    ],
                ],
            ],
            "analyzer"    => [
                "search_analyzer" => [
                    "type"        => "custom",
                    "tokenizer"   => "standard",
                    "filter"      => [
                        "lowercase",
                        "russian_stemmer",
                        "russian_stop",
                        "synonym_filter",
                        "shingle",
                    ],
                    "char_filter" => [
                        "eCharFilter",
                    ],
                ],
                "autocomplete"    => [
                    "type"      => "custom",
                    "tokenizer" => "standard",
                    "filter"    => [
                        "lowercase",
                        "autocomplete_filter",
                    ],
                ],
            ],
            "filter"      => [
                "shingle"             => [
                    "type"             => "shingle",
                    "min_shingle_size" => 2,
                    "max_shingle_size" => 3,
                ],
                "russian_stop"        => [
                    "type" => "stop",
                ],
                "russian_stemmer"     => [
                    "type"     => "stemmer",
                    "language" => "russian",
                ],
                "synonym_filter"      => [
                    "type"     => "synonym_graph",
                    "expand"   => false,
                    "synonyms" => [],
                ],
                "autocomplete_filter" => [
                    "type"     => "edge_ngram",
                    "min_gram" => 1,
                    "max_gram" => 10,
                ],
            ],
        ],
    ],
];
