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

if ( ! class_exists( 'WpssoJsonFiltersTypeSoftwareApplication' ) ) {

	class WpssoJsonFiltersTypeSoftwareApplication {

		private $p;

		public function __construct( &$plugin ) {

			$this->p =& $plugin;

			if ( $this->p->debug->enabled ) {

				$this->p->debug->mark();
			}

			$this->p->util->add_plugin_filters( $this, array(
				'json_data_https_schema_org_softwareapplication' => 5,
			) );
		}

		public function filter_json_data_https_schema_org_softwareapplication( $json_data, $mod, $mt_og, $page_type_id, $is_main ) {

			if ( $this->p->debug->enabled ) {

				$this->p->debug->mark();
			}

			$json_ret = array();

			if ( ! empty( $mod[ 'obj' ] ) ) {	// Just in case.

				$md_opts = SucomUtil::get_opts_begin( 'schema_software_app_', (array) $mod[ 'obj' ]->get_options( $mod[ 'id' ] ) );
			}

			/**
			 * Property:
			 * 	applicationCategory
			 */
			if ( ! empty( $md_opts[ 'schema_software_app_cat' ] ) ) {

				$json_ret[ 'applicationCategory' ] = (string) $md_opts[ 'schema_software_app_cat' ];
			}

			/**
			 * Property:
			 * 	operatingSystem
			 */
			if ( ! empty( $md_opts[ 'schema_software_app_os' ] ) ) {

				$json_ret[ 'operatingSystem' ] = (string) $md_opts[ 'schema_software_app_os' ];
			}

			WpssoSchema::add_data_itemprop_from_assoc( $json_ret, $mt_og, array( 
				'material' => 'product:material',
			) );

			/**
			 * Prevent recursion for an itemOffered within a Schema Offer.
			 */
			static $local_recursion = false;

			if ( ! $local_recursion ) {

				$local_recursion = true;

				/**
				 * Property:
				 * 	offers as https://schema.org/Offer
				 */
				if ( empty( $mt_og[ 'product:offers' ] ) ) {

					if ( $this->p->debug->enabled ) {

						$this->p->debug->log( 'getting single offer data' );
					}

					if ( $single_offer = WpssoSchemaSingle::get_offer_data( $mod, $mt_og ) ) {

						if ( $this->p->debug->enabled ) {

							$this->p->debug->log_arr( '$single_offer', $single_offer );
						}

						$json_ret[ 'offers' ] = WpssoSchema::get_schema_type_context( 'https://schema.org/Offer', $single_offer );

					} elseif ( $this->p->debug->enabled ) {

						$this->p->debug->log( 'returned $single_offer is empty' );
					}

				/**
				 * Property:
				 * 	offers as https://schema.org/AggregateOffer
				 */
				} elseif ( is_array( $mt_og[ 'product:offers' ] ) ) {	// Just in case - must be an array.

					if ( $this->p->debug->enabled ) {

						$this->p->debug->log( 'getting aggregate offer data' );
					}

					WpssoSchema::add_aggregate_offer_data( $json_ret, $mod, $mt_og[ 'product:offers' ] );
				}

				$local_recursion = false;

			} else {

				if ( $this->p->debug->enabled ) {

					$this->p->debug->log( 'product offer recursion detected and avoided' );
				}
			}

			return WpssoSchema::return_data_from_filter( $json_data, $json_ret, $is_main );
		}
	}
}
