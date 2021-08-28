<?php
/**
 * IMPORTANT: READ THE LICENSE AGREEMENT CAREFULLY. BY INSTALLING, COPYING, RUNNING, OR OTHERWISE USING THE WPSSO SCHEMA JSON-LD
 * MARKUP (WPSSO JSON) PREMIUM APPLICATION, YOU AGREE TO BE BOUND BY THE TERMS OF ITS LICENSE AGREEMENT. IF YOU DO NOT AGREE TO THE
 * TERMS OF ITS LICENSE AGREEMENT, DO NOT INSTALL, RUN, COPY, OR OTHERWISE USE THE WPSSO SCHEMA JSON-LD MARKUP (WPSSO JSON) PREMIUM
 * APPLICATION.
 * 
 * License URI: https://wpsso.com/wp-content/plugins/wpsso-schema-json-ld/license/premium.txt
 * 
 * Copyright 2016-2020 Jean-Sebastien Morisset (https://wpsso.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {

	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! class_exists( 'WpssoJsonFiltersTypeCreativeWork' ) ) {

	class WpssoJsonFiltersTypeCreativeWork {

		private $p;

		public function __construct( &$plugin ) {

			$this->p =& $plugin;

			if ( $this->p->debug->enabled ) {

				$this->p->debug->mark();
			}

			$this->p->util->add_plugin_filters( $this, array(
				'json_data_https_schema_org_creativework' => 5,
			) );
		}

		public function filter_json_data_https_schema_org_creativework( $json_data, $mod, $mt_og, $page_type_id, $is_main ) {

			if ( $this->p->debug->enabled ) {

				$this->p->debug->mark();
			}

			$json_ret = array();

			$org_logo_key = 'org_logo_url';

			/**
			 * Property:
			 *      text
			 */
			if ( ! empty( $this->p->options[ 'schema_add_text_prop' ] ) ) {

				$text_max_len = $this->p->options[ 'schema_text_max_len' ];

				$json_ret[ 'text' ] = $this->p->page->get_text( $text_max_len, $dots = '...', $mod );
			}

			/**
			 * Property:
			 *      image as https://schema.org/ImageObject
			 *      video as https://schema.org/VideoObject
			 */
			WpssoSchema::add_media_data( $json_ret, $mod, $mt_og, $size_names = 'schema', $add_video = true );

			WpssoSchema::check_required( $json_ret, $mod, array( 'image' ) );

			/**
			 * Property:
			 *      provider
			 *      publisher
			 */
			if ( ! empty( $mod[ 'obj' ] ) ) {	// Just in case.

				/**
				 * The meta data key is unique, but the Schema property name may be repeated to add more than one
				 * value to a property array.
				 */
				foreach ( array(
					'schema_prov_org_id'    => 'provider',
					'schema_prov_person_id' => 'provider',
					'schema_pub_org_id'     => 'publisher',
					'schema_pub_person_id'  => 'publisher',
				) as $md_key => $prop_name ) {

					$md_val = $mod[ 'obj' ]->get_options( $mod[ 'id' ], $md_key, $filter_opts = true, $pad_opts = true );

					if ( WpssoSchema::is_valid_val( $md_val ) ) {	// Not null, an empty string, or 'none'.

						if ( strpos( $md_key, '_org_id' ) ) {

							WpssoSchemaSingle::add_organization_data( $json_ret[ $prop_name ], $mod, $md_val, $org_logo_key, $list_element = true );

						} elseif ( strpos( $md_key, '_person_id' ) ) {

							WpssoSchemaSingle::add_person_data( $json_ret[ $prop_name ], $mod, $md_val, $list_element = true );
						}
					}
				}
			}

			/**
			 * Property:
			 * 	isPartOf
			 */
			$json_ret[ 'isPartOf' ] = array();

			if ( ! empty( $mod[ 'obj' ] ) )	{ // Just in case.

				$md_opts = $mod[ 'obj' ]->get_options( $mod[ 'id' ] );

				if ( is_array( $md_opts ) ) {	// Just in case.

					foreach ( SucomUtil::preg_grep_keys( '/^schema_ispartof_url_([0-9]+)$/',
						$md_opts, $invert = false, $replace = true ) as $num => $ispartof_url ) {

						if ( empty( $md_opts[ 'schema_ispartof_type_' . $num ] ) ) {

							$ispartof_type_url = 'https://schema.org/CreativeWork';

						} else {

							$ispartof_type_url = $this->p->schema->get_schema_type_url( $md_opts[ 'schema_ispartof_type_' . $num ] );
						}
					
						$json_ret[ 'isPartOf' ][] = WpssoSchema::get_schema_type_context( $ispartof_type_url, array(
							'url' => $ispartof_url,
						) );
					}
				}
			}

			$json_ret[ 'isPartOf' ] = (array) apply_filters( $this->p->lca . '_json_prop_https_schema_org_ispartof',
				$json_ret[ 'isPartOf' ], $mod, $mt_og, $page_type_id, $is_main );

			/**
			 * Property:
			 * 	headline
			 */
			if ( ! empty( $mod[ 'obj' ] ) )	{ // Just in case.

				$json_ret[ 'headline' ] = $mod[ 'obj' ]->get_options( $mod[ 'id' ], 'schema_headline' );	// Returns null if index key is not found.
			}

			if ( ! empty( $json_ret[ 'headline' ] ) ) {	// Must be a non-empty string.

				if ( $this->p->debug->enabled ) {

					$this->p->debug->log( 'found custom meta headline = ' . $json_ret[ 'headline' ] );
				}

			} else {

				$headline_max_len = $this->p->cf[ 'head' ][ 'limit_max' ][ 'schema_headline_len' ];

				$json_ret[ 'headline' ] = $this->p->page->get_title( $headline_max_len, '...', $mod );
			}

			/**
			 * Property:
			 *      keywords
			 */
			$json_ret[ 'keywords' ] = $this->p->page->get_keywords( $mod, $read_cache = true, $md_key = 'schema_keywords' );

			/**
			 * Property:
			 *      copyrightYear
			 *	license
			 *	isFamilyFriendly
			 *	inLanguage
			 */
			if ( ! empty( $mod[ 'obj' ] ) ) {

				/**
				 * The meta data key is unique, but the Schema property name may be repeated to add more than one
				 * value to a property array.
				 */
				foreach ( array(
					'schema_copyright_year'  => 'copyrightYear',
					'schema_license_url'     => 'license',
					'schema_family_friendly' => 'isFamilyFriendly',
					'schema_lang'            => 'inLanguage',
				) as $md_key => $prop_name ) {

					$md_val = $mod[ 'obj' ]->get_options( $mod[ 'id' ], $md_key, $filter_opts = true, $pad_opts = true );

					if ( WpssoSchema::is_valid_val( $md_val ) ) {	// Not null, an empty string, or 'none'.

						switch ( $prop_name ) {

							case 'isFamilyFriendly':	// Must be a true or false boolean value.
	
								$md_val = empty( $md_val ) ? false : true;

								break;
						}

						$json_ret[ $prop_name ] = $md_val;
					}
				}
			}

			/**
			 * Property:
			 *      dateCreated
			 *      datePublished
			 *      dateModified
			 */
			WpssoSchema::add_data_itemprop_from_assoc( $json_ret, $mt_og, array(
				'dateCreated'   => 'article:published_time',	// In WordPress, created and published times are the same.
				'datePublished' => 'article:published_time',
				'dateModified'  => 'article:modified_time',
			) );

			/**
			 * Property:
			 *      author as https://schema.org/Person
			 *      contributor as https://schema.org/Person
			 */
			WpssoSchema::add_author_coauthor_data( $json_ret, $mod );

			/**
			 * Property:
			 *      thumbnailURL
			 */
			$json_ret[ 'thumbnailUrl' ] = $this->p->og->get_thumbnail_url( $this->p->lca . '-thumbnail', $mod, $md_pre = 'schema' );

			/**
			 * Property:
			 *      comment as https://schema.org/Comment
			 *      commentCount
			 */
			WpssoSchema::add_comment_list_data( $json_ret, $mod );

			return WpssoSchema::return_data_from_filter( $json_data, $json_ret, $is_main );
		}
	}
}
