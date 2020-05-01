<?php

$finder = PhpCsFixer\Finder::create()
       ->in( __DIR__ . '/src' )
       ->exclude( 'vendor' );

return PhpCsFixer\Config::create()
    ->setRules( [
        '@PSR1'                                       => true,
        '@PSR2'                                       => true,
        'array_indentation'                           => true,
        'array_syntax'                                => [ 'syntax' => 'short' ],
        'blank_line_before_statement' => [
	        'statements' => ['break', 'continue', 'declare', 'for', 'foreach', 'if', 'return', 'switch', 'throw', 'try', 'while'], // if else elseif impossible ???
		],
        'declare_strict_types'                        => true,
        'dir_constant'                                => true,
        'ereg_to_preg'                                => true,
        'explicit_indirect_variable'                  => true,
        'explicit_string_variable' => true,
        'is_null'                                     => true,
        'lowercase_static_reference'                  => true,
        'mb_str_functions' => true,
        'method_argument_space'                       => [
            'on_multiline' => 'ensure_single_line',
        ],
        'method_chaining_indentation'                 => true,
        'modernize_types_casting'                     => true,
        'multiline_comment_opening_closing'           => true,
        'multiline_whitespace_before_semicolons'      => [
            'strategy' => 'new_line_for_chained_calls',
        ],
        'native_function_casing'                      => true,
        'native_function_type_declaration_casing'     => true,
        'new_with_braces' => true,
        'no_alternative_syntax'                       => true,
        'no_blank_lines_after_class_opening'          => true,
        'no_blank_lines_after_phpdoc'                 => true,
        'no_empty_comment'                            => true,
        'no_empty_phpdoc'                             => true,
        'no_empty_statement'                          => true,
        'no_extra_blank_lines'                        => [
            'extra',
        ],
        'no_leading_namespace_whitespace'             => true,
        'no_multiline_whitespace_around_double_arrow' => true,
        'no_singleline_whitespace_before_semicolons'  => true,
        'no_spaces_around_offset'                     => [
            'positions' => [ 'inside', 'outside' ],
        ],
        'no_trailing_comma_in_list_call'              => true,
        'no_trailing_comma_in_singleline_array'       => true,
        'no_unreachable_default_argument_value'       => true,
        'no_unused_imports'                           => true,
        'no_whitespace_before_comma_in_array'         => [
            'after_heredoc' => true,
        ],
        'no_whitespace_in_blank_line'                 => true,
        'non_printable_character'                     => [
            'use_escape_sequences_in_strings' => true
        ],
        'normalize_index_brace'                       => true,
        'nullable_type_declaration_for_default_null_value' =>[
			'use_nullable_type_declaration' => true,
		],
        'object_operator_without_whitespace'          => true,
        'phpdoc_add_missing_param_annotation'         => true,
        'phpdoc_no_empty_return'                      => true,
        'phpdoc_no_useless_inheritdoc'                => true,
        'phpdoc_separation'                           => true,
        'psr4'                                        => true,
        'semicolon_after_instruction'                 => true,
        'short_scalar_cast'                           => true,
        'simple_to_complex_string_variable'           => true,
        'single_line_throw'                           => true,
        'single_quote'                                => [
            'strings_containing_single_quote_chars' => true,
        ],
        'standardize_increment'                       => true,
        'standardize_not_equals'                      => true,
        'ternary_operator_spaces'                     => true,
        'ternary_to_null_coalescing'                  => true,
        'trailing_comma_in_multiline_array'           => true,
        'void_return'                                 => true,
        'whitespace_after_comma_in_array'             => true,
        'yoda_style'                                  => true,

    ] )
    ->setFinder( $finder );
