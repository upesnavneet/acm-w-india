<?php

/**  
 * Copyright 2013-2024 Epsiloncool
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 ******************************************************************************
 *  I am thank you for the help by buying PRO version of this plugin 
 *  at https://fulltextsearch.org/ 
 *  It will keep me working further on this useful product.
 ******************************************************************************
 * 
 *  @copyright 2013-2024
 *  @license GPLv3
 *  @package WP Fast Total Search
 *  @author Epsiloncool <info@e-wm.org>
 */

require_once dirname(__FILE__).'/wpfts_tokencollector.php';

class WPFTS_Result_Item
{
	protected $_demodata = array(
		'post_link' => '/the-secret-lives-of-intps/',
		'post_title' => 'The Secret Lives of INTPs',
		'file_link' => '/wp-content/uploads/2018/03/The-Secret-Lives-of-INTPs.pdf',
		'post_excerpt' => 'An <b>INTP</b> <b>child</b> may enjoy constructing pens, building  tunnel systems for rodents, and laying out aquariums and terrariums. An <b>INTP</b> <b>Family</b> What about an <b>INTP</b> <b>family</b> setting? Thus, a listener can conclude that the speaker saw an eagle-like <b>bird</b> flying over what should probably  be considered a smallish hill exactly fourteen days previously.',
		'score' => 0.17,
		'filesize' => 1720000,
		'not_found_words' => array('timeliness', 'iridescence'),
	);
	public $demo_mode = false;
	public $post = array();
	public $is_post = false;

	public function __construct($post_id = false, $post = null)
	{
		$this->post = array();
		$this->is_post = false;

		if ($post && is_object($post)) {
			$this->demo_mode = false;
			$this->post = get_post($post->ID, ARRAY_A);
			if ($this->post) {
				$this->is_post = true;
				$this->post['relev'] = $post->relev;
			}
		} elseif ($post_id !== false) {
			$this->demo_mode = false;
			$this->post = get_post($post_id, ARRAY_A);
			if ($this->post) {
				$this->is_post = true;
			}
		} else {
			$this->demo_mode = true;
		}
	}

	public function SetLinkCache($object_id, $object_type, $url)
	{
		if (!isset($GLOBALS['wpfts_smart_excerpt_link_cache'])) {
			$GLOBALS['wpfts_smart_excerpt_link_cache'] = array();
		}
		$GLOBALS['wpfts_smart_excerpt_link_cache'][$object_type.'/'.$object_id] = $url;
	}

	public function GetLinkCache($object_id, $object_type)
	{
		if (isset($GLOBALS['wpfts_smart_excerpt_link_cache'][$object_type.'/'.$object_id])) {
			return $GLOBALS['wpfts_smart_excerpt_link_cache'][$object_type.'/'.$object_id];
		} else {
			return false;
		}
	}

	public function TitleLink($link = false)
	{
		global $wpfts_core;

		$is_attachment = 1;
		if ($this->demo_mode) {
			if (intval($wpfts_core->get_option('is_title_direct_link')) != 0) {
				$link = $this->_demodata['file_link'];
			} else {
				$link = $this->_demodata['post_link'];
			}
		} else {
			// Real case
			// Save the post link for further usage (we need it in the Smart Excerpt generator, but the_excerpt hook does not send post url, that's why)
			$this->SetLinkCache($this->post['ID'], 'wp_posts', $link);

			$is_attachment = ($this->post['post_type'] == 'attachment') ? 1 : 0;
			if ($is_attachment) {
				if (intval($wpfts_core->get_option('is_title_direct_link')) != 0) {
					$link = wp_get_attachment_url($this->post['ID']);
				} else {
					// Use original link
				}
			} else {
				// Use original link
			}
		}

		$r1 = array(
			'is_demo' => $this->demo_mode,
			'is_attachment' => $is_attachment,
			'is_title_direct_link' => (intval($wpfts_core->get_option('is_title_direct_link') != 0)) ? 1 : 0,
			'link' => $link,
		);
		$r1 = apply_filters('wpfts_se_titlelink', $r1, $this->post);

		return isset($r1['link']) ? $r1['link'] : '';
	}

	public function TitleText($title = false)
	{
		global $wpfts_core;

		$is_attachment = ((isset($this->post['post_type'])) && ($this->post['post_type'] == 'attachment'));
		if ($this->demo_mode) {
			$is_attachment = true;
			$filepath = $this->_demodata['file_link'];
			$post_title = $this->_demodata['post_title'];
		} else {
			// Real case
			if ($title !== false) {
				$post_title = $title;
			} else {
				if (($this->is_post) && (isset($this->post['post_title']))) {
					$post_title = $this->post['post_title'];
				} else {
					$post_title = '';
				}
			}

			$filepath = wp_get_attachment_url($this->post['ID']);
		}
		$ext = (($p = mb_strrpos($filepath, '.')) !== false) ? mb_substr($filepath, $p + 1) : '';
		$ext = mb_strtoupper($ext);
		if ((intval($wpfts_core->get_option('is_file_ext')) != 0) && (strlen($ext) > 0) && ($is_attachment)) {
			$ret_title = '<sup>['.$ext.']</sup> '.$post_title;
		} else {
			$ret_title = $post_title;
		}

		$r1 = array(
			'is_demo' => $this->demo_mode,
			'is_attachment' => $is_attachment,
			'is_file_ext' => intval($wpfts_core->get_option('is_file_ext')) != 0 ? 1 : 0,
			'title' => $ret_title,
		);

		$r1 = apply_filters('wpfts_se_titletext', $r1, $this->post);

		return isset($r1['title']) ? $r1['title'] : '';
	}

	public function cutToSentences($s)
	{
		$fulltext = html_entity_decode(str_replace('&nbsp;', ' ', $s));
		// Prepare fulltext for Smart Excerpt-ing
		$fulltext = str_replace('<', ' <', $fulltext);
		$fulltext = preg_replace('~\s+~', ' ', $fulltext);
		$fulltext = htmlspecialchars($fulltext);
		$fulltext = mb_convert_encoding($fulltext, 'UTF-8', 'UTF-8');	// Guarantee a valid UTF-8 string!

		// Split text to sentences and add "\n" after each sentence
		$fulltext = preg_replace('~([\.\!\?]\s|\W{4,}?)~u', '$1'."\n", $fulltext);

		return $fulltext;
	}

	public function iterateArray($arr, $key, $callback = null) {
		if (is_array($arr) && is_callable($callback)) {
			foreach ($arr as $k => $d) {
				$keynew = $key.'/'.$k;
				if (is_string($d)) {
					$callback($keynew, $d);
				} elseif (is_array($d)) {
					$this->iterateArray($d, $keynew, $callback);
				}
			}
		}
	}

	public function GetExcData($query = '')
	{
		//ini_set('pcre.jit', 0);

		global $wpfts_core;

		$chunks = $wpfts_core->getPostChunks($this->post['ID']);

		if (is_array($chunks) && isset($chunks['__include_children'])) {
			$sch = $wpfts_core->getSubPostChunks($chunks['__include_children'], $this->post['ID'], 'wp_posts');		
			if ($sch && is_array($sch)) {
				foreach ($sch as $k => $d) {
					$chunks[$k] = $d;
				}
			}
		}

		$fulltext = '';
		$markup = array();
		if ($chunks) {
			foreach ($chunks as $k => $d) {
				if (($k != 'post_title') && (mb_substr($k, 0, 2) != '__')) {
					if (is_string($d)) {
						$start_offset = strlen($fulltext);

						// Clear text and cut to sentences
						$str_sents = $this->cutToSentences($d);

						$fulltext .= $str_sents;
						$fulltext .= "\n";
						$markup[$k] = array($start_offset);
					} elseif (is_array($d)) {
						$this->iterateArray($d, $k, function($key, $text) use (&$markup, &$fulltext){
							$start_offset = strlen($fulltext);

							// Clear text and cut to sentences
							$str_sents = $this->cutToSentences($text);
	
							$fulltext .= $str_sents;
							$fulltext .= "\n";
							$markup[$key] = array($start_offset);	
						});							
					}	
				}
			}
		}

		$fulltext = apply_filters('wpfts_get_fulltext', $fulltext, $this->post['ID']);

		// Find key word positions
		$ws = $wpfts_core->split_to_words($query);
		
		$sents = array();
		$ii = 0;
		foreach ($ws as $w) {
			// Lets try to catch some hares in the same time
			//$i = preg_match_all('~([\.\!\?]\s|^)([^\.\!\?]*((?<=\W)'.preg_quote($w).'[^\.\?\!]*)([\.\!\?]\s|[\.\!\?]$|$))~Uius', $fulltext, $zz, PREG_OFFSET_CAPTURE);
			//preg_match_all('~(?<=[\.\!\?]\s|^)(([^\.\!\?]|[\.\!\?](?!\s))*'.preg_quote($w).'([^\.\!\?]|[\.\!\?](?!\s))*)([\.\!\?]\s|[\.\!\?]$|$)~Uius', $fulltext, $zz, PREG_OFFSET_CAPTURE);

			preg_match_all('~(.*(\b'.$w.').*)~iu', $fulltext, $zz, PREG_OFFSET_CAPTURE);

			$ssa = array();
			if (isset($zz[0])) {
				// A list of sentences and offsets
				foreach ($zz[0] as $kk => $dd) {
					$ssa[$dd[1]] = array($dd[0], $zz[2][$kk][1] - $dd[1]);	// Sentence plus word offset
				}
			}
			$sents['t'.$ii] = $ssa;
			$ii ++;
		}

		$tc = new WPFTS_TokenCollector();
		$tc->tokenlist = $sents;

		$nominal_length = intval($wpfts_core->get_option('optimal_length'));
		if ($nominal_length < 10) {
			$nominal_length = 300;
		}

		$minlength = $nominal_length * 0.9;
		$maxlength = $nominal_length * 1.1;

		$goal = '';
		for ($i = 0; $i < count($sents); $i ++) {
			$goal .= ''.$i;
		}

		$fullgoal = $goal;

		$bestsentenses = array();
		$total_length = 0;
		$outt = array();
		$is_goal_done = false;

		$goal = $fullgoal;

		$g_wdt = 100;
		while (true) {

			$wdt = strlen($goal);

			$is_found_any = false;
			$is_can_not_more = false;
			$is_filled = false;

//echo 'Full Goal: '.$fullgoal."\n";

			while (strlen($goal) > 0) {
//echo 'Current Goal: '.$goal."\n";
				$mp = $tc->GetMostPowerful($goal, $fullgoal, $outt);

				if ($mp && isset($mp[1]) && (count($mp[1]) > 0) && isset($mp[0]) && (strlen($mp[0]) > 0)) {

					// Calculate min_length and max_length for this piece
					$nom_len = $nominal_length * strlen($mp[0]) / strlen($fullgoal);
					$min_len = $nom_len * 0.9;
					$max_len = $nom_len * 1.1;

					$local_used_len = 0;

					if (strlen($mp[0]) > 1) {
						$t_ordered = $tc->GetOrderedByLessDistance($mp);
					} else {
						$t_ordered = $mp;
					}

					// Looping by found sentences, trying to find first sentence, 
					// which one is allowed by length (shorter than max)
					$n_sentences_used = 0;
					foreach ($t_ordered[1] as $tt_k => $tt_v) {
						$ss = trim($tt_v[0]);
						$ss_len = mb_strlen($ss, 'utf-8');

						if ($ss_len <= ($max_len - $local_used_len)) {
							// This one is good!
							$outt[$tt_k] = $ss;
							$total_length += $ss_len;
							$local_used_len += $ss_len;
							$n_sentences_used ++;

							// Check if it's enough for this goal
							if ($local_used_len >= $min_len) {
								break;
							}
						}
					}

					if ($n_sentences_used < 1) {
						// We have a problem, let's use different algorithm to generate excerpt for this goal
//echo 'SPECIAL ALGORITHM!'."\n";
						// Step1: check how much space we have and compare with delta from first term to last term
						$remaining_len = $max_len - $local_used_len;

						$ii = 0;
						foreach ($t_ordered[1] as $tt_k => $tt_v) {
							if ($ii > 0) {
								// We need only first element
								break;
							}
							$ii ++;

							// Let's calculate remaining length in bytes (should be more in bytes than in chars, it depends from the string we analyzing)
							$remaining_len_bytes =  floor($remaining_len * strlen($tt_v[0]) / mb_strlen($tt_v[0], 'utf-8'));

							if (isset($tt_v[2]) && (count($tt_v[2]) > 0)) {
								// More than 1 term here
								$first_term_pos = min($tt_v[2]);
								$last_term_pos = max($tt_v[2]);
								$sentc_len = $last_term_pos - $first_term_pos;

							} else {
								// Only one word, let's find margin
								$first_term_pos = $last_term_pos = $tt_v[1];
								$sentc_len = 0;
							}

							// Check margins
							$margin = ($remaining_len_bytes - $sentc_len) / 2;

							if ($margin > 0) {

								$margin1 = $first_term_pos - $margin;
								$margin2 = $last_term_pos + $margin;

								$is_begin_3p = true;
								$is_end_3p = true;

								if ($margin1 < 0) {
									$margin1 -= $margin1;
									$margin2 -= $margin1;
									$is_begin_3p = false;
								} else {
									if ($margin2 > strlen($tt_v[0])) {
										$margin2 -= ($margin2 - strlen($tt_v[0]));
										$margin1 -= ($margin2 - strlen($tt_v[0]));
										$is_end_3p = false;
									}
								}

								// Good, let's find next space/letter after first margin and next space/letter after last margin
								$matches2 = array();
								preg_match_all('~\W+~u', $tt_v[0], $matches2, PREG_OFFSET_CAPTURE);

								if (isset($matches2[0]) && is_array($matches2[0])) {
									$t_start = $margin1;
									$t_end = $margin2;
									foreach ($matches2[0] as $t2) {
										$zz = $t2[1] + strlen($t2[0]);
										if ($zz < $margin1) {
											$t_start = $zz;
										}
										if ($t2[1] > $margin2) {
											$t_end = $t2[1];
											break;
										}
									}
	
									$tt_text = ($is_begin_3p ? '...' : '').substr($tt_v[0], $t_start, $t_end - $t_start).($is_end_3p ? '...' : '');
								} else {
									// No spaces?? Let's cut the string as is
									$tt_text = ($is_begin_3p ? '...' : '').substr($tt_v[0], $margin1, $margin2 - $margin1).($is_end_3p ? '...' : '');
								}

							} else {
								// We need to break the line to some parts
								$ts = $tt_v[2];
								usort($ts, function($v1, $v2)
								{
									return $v1 < $v2 ? - 1 : 1;
								});

								$margin = floor($remaining_len_bytes / count($ts) / 2);

								$ts_data = array();
								foreach ($ts as $z2) {
									$t_start = $z2 - $margin;
									$t_end = $z2 + $margin;
									$is_start_3p = true;
									$is_end_3p = true;
									if ($t_start < 0) {
										$t_start -= $t_start;
										$t_end -= $t_start;
										$is_start_3p = false;
									} else {
										if ($t_end > strlen($tt_v[0])) {
											$t_end -= ($t_end - strlen($tt_v[0]));
											$t_start -= ($t_end - strlen($tt_v[0]));
											$is_end_3p = false;
										}
									}
									$ts_data[] = array(
										'start' => $t_start,
										'margin1' => $t_start,
										'end' => $t_end,
										'margin2' => $t_end,
										'is_start_3p' => $is_start_3p,
										'is_end_3p' => $is_end_3p,
										'base' => $z2,
										't_c' => 0,	// Counter used to calculate end_offset
									);
								}

								// Find empty spaces
								$matches2 = array();
								preg_match_all('~\W+~u', $tt_v[0], $matches2, PREG_OFFSET_CAPTURE);

								if (isset($matches2[0]) && is_array($matches2[0])) {
									foreach ($matches2[0] as $t2) {
										$zz = $t2[1] + strlen($t2[0]);

										foreach ($ts_data as $ts_k => $ts_item) {
											if ($zz < $ts_item['margin1']) {
												$ts_data[$ts_k]['start'] = $zz;
											}
											if ($t2[1] > $ts_item['margin2']) {
												if ($ts_item['t_c'] < 2) {
													$ts_data[$ts_k]['end'] = $t2[1];
													$ts_data[$ts_k]['t_c'] ++;
												}
											}
										}
									}
//echo 'Before overlap check'."\n";
//print_r($ts_data);
									// Let's detect if we have overlaps
									$has_overlaps = true;
									while ($has_overlaps) {
										$has_overlaps = false;

										$k_pre = false;
										foreach ($ts_data as $ts_k => $ts_item) {
											
											if ($k_pre === false) {
												$k_pre = $ts_k;
												continue;
											}
											if ($ts_data[$k_pre]['end'] >= $ts_item['start']) {
												// Overlap!
//echo 'Overlap detected: '.$k_pre.' - '.$ts_k."\n";
												$has_overlaps = true;
												// Merge and repeat
												$ts_data[$ts_k]['start'] = $ts_data[$k_pre]['start'];
												$ts_data[$ts_k]['margin1'] = $ts_data[$k_pre]['margin1'];
												$ts_data[$ts_k]['is_start_3p'] = $ts_data[$k_pre]['is_start_3p'];
												
												unset($ts_data[$k_pre]);

												break;
											}
											$k_pre = $ts_k;
										}
									}
								}
								// Assume we merged overlaps, now let's construct the final string

								$pieces = array();
								$k_pre = false;
								foreach ($ts_data as $ts_k => $ts_item) {
									if ($k_pre !== false) {
										// Not first element
										$pieces[] = substr($tt_v[0], $ts_item['start'], $ts_item['end'] - $ts_item['start']).($ts_item['is_end_3p'] ? ' ... ' : '');
									} else {
										// First element
										$pieces[] = ($ts_item['is_start_3p'] ? ' ... ' : '').substr($tt_v[0], $ts_item['start'], $ts_item['end'] - $ts_item['start']).($ts_item['is_end_3p'] ? ' ... ' : '');
									}
									$k_pre = $ts_k;
								}

								$tt_text = implode('', $pieces);
//echo 'tt_text = '.$tt_text."\n";

							}

							$outt[$tt_k] = $tt_text;
							$ss_len = mb_strlen($tt_text, 'utf-8');
							$total_length += $ss_len;
							$local_used_len += $ss_len;
							break;
						}

						// If enough space, let's cut text from the start and from the end to leave as much context as possible

						// If not enough space, then we need to cut out words separately


					}

					//$bestsentenses[] = $t_ordered;
					
					// Remove found terms from the goal
					$b = '';
					for ($i = 0; $i < strlen($goal); $i ++) {
						if (strpos($mp[0], $goal[$i]) === false) {
							$b .= $goal[$i];
						}
					}

					// New goal
					$goal = $b;
//echo 'New goal='.$goal."\n";
				} else {
					// We can not extract more, tried all combinations, but can't
					$is_can_not_more = true;
					break;
				}
				$wdt --;
				if ($wdt < 0) {
					// Watchdog triggered
					break;
				}
			}
			if (($total_length > $minlength) || ($is_can_not_more) || $is_filled) {
				break;
			}
			if (strlen($goal) < 1) {
				$is_goal_done = true;
				break;
			}
			
			$g_wdt--;
			if ($g_wdt < 1) {
				break;
			}
		}

		// Sort $outt by keys
		uksort($outt, function($v1, $v2) {
			return ($v1 > $v2) ? 1 : (($v1 < $v2) ? -1 : 0);
		});

		// Prepare some data
		$page_url = $this->GetLinkCache($this->post['ID'], 'wp_posts');
		if (!$page_url) {
			$page_url = get_permalink($this->post['ID']);
		}
		$is_attachment = ($this->post['post_type'] == 'attachment') ? 1 : 0;
		if ($is_attachment) {
			if (intval($wpfts_core->get_option('is_title_direct_link')) != 0) {
				$page_url = wp_get_attachment_url($this->post['ID']);
			} else {
				// Use original link
			}
		} else {
			// Use original link
		}

		$outs = array();
		foreach ($outt as $k => $d) {
			// Find key by offset
			$full_key = '';
			foreach ($markup as $tkey => $tval) {
				if (isset($tval[0])) {
					if ($tval[0] > $k) {
						break;
					}
				}
				$full_key = $tkey;
			}

			// Make this item beautiful using the key
			$sentence_styles = apply_filters('wpfts_get_sentence_styles', $wpfts_core->get_option('sentence_styles'));

			$outtext = $this->applySentenceStyles($sentence_styles, $full_key, $ws, $d, $page_url);

			$outtext = apply_filters('wpfts_apply_sentence_styles', $outtext, $sentence_styles, $full_key, $ws, $d);

			$outs[] = $outtext;
		}

		$outtext = implode(" ... ", $outs);

		$goal_words = array();
		if (!$is_goal_done) {
			for ($i = 0; $i < strlen($goal); $i ++) {
				if (isset($ws[$goal[$i]])) {
					$goal_words[] = $ws[$goal[$i]];
				}
			}
		}

		return array(
			'text' => $outtext,
			'no_words' => $goal_words,
		);
	}

	public function applySentenceStyles($sentence_styles, $key, $words, $sentence, $page_url)
	{
		$rpl = array();
		$is_found = false;
		$fst = array();
		if (is_array($sentence_styles)) {
			foreach ($sentence_styles as $st) {
				if (isset($st['is_on']) && (intval($st['is_on']) != 0)) {
					if (isset($st['key_term']) && (strlen($st['key_term'])) > 0) {
						if (isset($st['is_regexp']) && (intval($st['is_regexp']) != 0)) {
							// Use RegExp
							$zz = array();
							if (preg_match('~^'.($st['key_term']).'$~', $key, $zz)) {
								foreach ($zz as $k => $z) {
									$rpl['{{$'.$k.'}}'] = $z;
								}
								$rpl['{{key}}'] = $key;
								$rpl['{{key_term}}'] = $st['key_term'];
								$fst = $st;
								$is_found = true;
								break;
							}
						} else {
							// Use string comparison
							if ($key == $st['key_term']) {
								$rpl['{{key_term}}'] = $st['key_term'];
								$rpl['{{key}}'] = $key;
								$fst = $st;
								$is_found = true;
								break;
							}
						}
					}
				}
			}

		} else {
			// Wrong sentence styles, use default algorithm
		}

		if ($is_found) {
			// We found a sentence_style record, let's apply
			$rpl['{{page_url}}'] = $page_url;
			$rpl['{{post_url}}'] = $page_url;
			$rpl['{{sentence}}'] = $sentence;
			$rpl['{{word}}'] = implode(',', $words);

			$cap = '';
			if (strlen($fst['caption'])) {
				$cap = '<span class="wpfts-caption">'.str_replace(array_keys($rpl), array_values($rpl), $fst['caption']).'</span>';
			}

			$outtext = $sentence;

			if (isset($fst['url_template']) && (strlen($fst['url_template']) > 0) && isset($fst['url_type']) && (intval($fst['url_type']) > 0)) {
				/**
				 * url_type: how we need to place links over caption, sentence and words?
				 * 0 = no links
				 * 1 = link caption only
				 * 2 = link each word only
				 * 3 = link each word and caption
				 * 4 = link sentence only
				 * 5 = link caption and sentence
				 */
				switch (intval($fst['url_type'])) {
					case 1:
						// Link caption only
						if (strlen($cap) > 0) {
							$cap = '<a href="'.esc_url($this->FillURLTemplate($fst['url_template'], $rpl)).'" class="wpfts-caption-link">'.$cap.'</a>';
						}
						$outtext = $this->HighlightTerms($outtext, $words);
						break;
					case 2:
						// Link each word only
						$outtext = $this->HighlightTerms($outtext, $words, $fst['url_template'], $rpl, true);
						break;
					case 3:
						// Link each word and caption
						if (strlen($cap) > 0) {
							$cap = '<a href="'.esc_url($this->FillURLTemplate($fst['url_template'], $rpl)).'" class="wpfts-caption-link">'.$cap.'</a>';
						}
						$outtext = $this->HighlightTerms($outtext, $words, $fst['url_template'], $rpl, true);
						break;
					case 4:
						// Link sentence only
						$outtext = '<a href="'.esc_url($this->FillURLTemplate($fst['url_template'], $rpl)).'" class="wpfts-sentence-link">'.$this->HighlightTerms($outtext, $words).'</a>';
						break;
					case 5:
						// Link caption and sentence
						if (strlen($cap) > 0) {
							$cap = '<a href="'.esc_url($this->FillURLTemplate($fst['url_template'], $rpl)).'" class="wpfts-caption-link">'.$cap.'</a>';
						}
						$outtext = '<a href="'.esc_url($this->FillURLTemplate($fst['url_template'], $rpl)).'" class="wpfts-sentence-link">'.$this->HighlightTerms($outtext, $words).'</a>';
						break;
					case 0:
					default:
						// No links
						$outtext = $this->HighlightTerms($outtext, $words);
				}

			} else {
				// No links (no url template or url_type = 0)
				$outtext = $this->HighlightTerms($outtext, $words);
			}

			$outtext = $cap.' '.$outtext;

		} else {
			// Default styling
			$outtext = $sentence;
			foreach ($words as $w) {
				//$outtext = preg_replace("/\p{L}*?".preg_quote($w)."\p{L}*/ui", "<b>$0</b>", $outtext);
				$outtext = preg_replace("/\b".preg_quote($w)."\p{L}*/ui", "<b>$0</b>", $outtext);
			}
			$outtext = '<span class="wpfts-sentence">'.$outtext.'</span>';
		}

		return $outtext;
/*
		'is_on' => 1,
		'is_regexp' => 1,
		'key_term' => '[^/]* /pages/page_(\d+)',
		'caption' => 'Page #{{$1}}',
		'newline_type' => 0,
		'url_type' => 1,
		'url_template' => '{{post_url}}&file_page={{$1}}&hl={{sentence}}',
		'class_name' => '',

					// Lets put highlighting
					$outtext = $d;
					foreach ($ws as $w) {
						//$outtext = preg_replace("/\p{L}*?".preg_quote($w)."\p{L}* /ui", "<b>$0</b>", $outtext);
						$outtext = preg_replace("/\b".preg_quote($w)."\p{L}* /ui", "<b>$0</b>", $outtext);
					}
		
					$outs[] = $full_key.': '.$outtext;
					*/
		
	}

	public function unparseURL($parts)
	{
		$scheme = isset($parts['scheme']) ? $parts['scheme'].'://' : '';
		$host = isset($parts['host']) ? $parts['host'] : '';
		$port = isset($parts['port']) ? ':'.$parts['port'] : '';
		$user = isset($parts['user']) ? $parts['user'] : '';
		$pass = isset($parts['pass']) ? ':'.$parts['pass']  : '';
		$pass = ((strlen($user) > 0) || (strlen($pass) > 0)) ? $pass.'@' : '';
		$path = isset($parts['path']) ? $parts['path'] : '';
		$query = isset($parts['query']) ? '?'.$parts['query'] : '';
		$fragment = isset($parts['fragment']) ? '#'.$parts['fragment'] : '';

		return $scheme.$user.$pass.$host.$port.$path.$query.$fragment;
	}

	public function fixURL($url)
	{
		// Initial fix
		$t1 = strpos($url, '&');
		$t2 = strpos($url, '?');
		
		if (($t1 !== false) && ($t2 !== false)) {
			if ($t1 < $t2) {
				// Replace first '&' by '?'
				$url = substr($url, 0, $t1).'?'.substr($url, $t1 + 1);
			}
		}
		
		$parts = parse_url($url);
		
		if (isset($parts['query']) && (strlen($parts['query']) > 0)) {
			$t3 = strpos($parts['query'], '?');
			if ($t3 !== false) {
				$parts['query'] = substr($parts['query'], 0, $t3).'&'.substr($parts['query'], $t3 + 1);
			}
		}
		
		return $this->unparseURL($parts);
	}

	public function FillURLTemplate($url_template, $rpl)
	{
		$url = str_replace(array_keys($rpl), array_values($rpl), $url_template);

		// Remove non-used placeholders
		$url = preg_replace('~\{\{[a-zA-Z0-9\_\$]+\}\}~U', '', $url);

		// Normalize the URL
		$url = $this->fixURL($url);

		return $url;
	}

	public function HighlightTerms($outtext, $words, $url_template = '', $rpl = array(), $is_add_word_links = false)
	{
		if ($is_add_word_links) {
			foreach ($words as $w) {
				if (strlen($url_template) > 0) {
					$rpl['{{word}}'] = $w;
					$word_url = $this->FillURLTemplate($url_template, $rpl);
					//$outtext = preg_replace("/\p{L}*?".preg_quote($w)."\p{L}*/ui", "<b>$0</b>", $outtext);
					$outtext = preg_replace("/\b".preg_quote($w)."\p{L}*/ui", '<a href="'.esc_url($word_url).'" class="wpfts-word-link"><b>$0</b></a>', $outtext);
				} else {
					$outtext = preg_replace("/\b".preg_quote($w)."\p{L}*/ui", '<b>$0</b>', $outtext);
				}
			}
		} else {
			// No links, only highlighting
			foreach ($words as $w) {
				//$outtext = preg_replace("/\p{L}*?".preg_quote($w)."\p{L}*/ui", "<b>$0</b>", $outtext);
				$outtext = preg_replace("/\b".preg_quote($w)."\p{L}*/ui", "<b>$0</b>", $outtext);
			}
		}

		return $outtext;
	}

	public function Excerpt($query = '')
	{
		global $wpfts_core;
		
		if ($this->demo_mode) {
			// Demo data
			$is_attachment = true;
			$excerpt_text = $this->_demodata['post_excerpt'];
			$score = $this->_demodata['score'];
			$filesize = $this->_demodata['filesize'];
			$file_link = $this->_demodata['file_link'];
			$nf_words = $this->_demodata['not_found_words'];
		} else {
			$is_attachment = ((isset($this->post['post_type'])) && ($this->post['post_type'] == 'attachment'));

			$score = isset($this->post['relev']) ? $this->post['relev'] : 0;
			if ($is_attachment) {
				$file_link = wp_get_attachment_url($this->post['ID']);
				$file_path = get_attached_file($this->post['ID']);
				if (is_file($file_path)) {
					$filesize = intval(@filesize($file_path));
				} else {
					$filesize = 0;
				}
			} else {
				$filesize = 0;
				$file_link = '#';
			}

			$excdata = $this->GetExcData($query);
			$excerpt_text = $excdata['text'];
			$nf_words = $excdata['no_words'];
		}

		$r1 = array();
		// Is Excerpt content
		$r1['is_excerpt_text'] = (intval($wpfts_core->get_option('is_smart_excerpt_text')) != 0) ? 1 : 0;
		// Excerpt content
		$r1['excerpt_text'] = (intval($wpfts_core->get_option('is_smart_excerpt_text')) != 0) ? $excerpt_text : false;
		// Not found words
		$r1['is_not_found_words'] = (intval($wpfts_core->get_option('is_not_found_words')) != 0) ? 1 : 0;
		$r1['not_found_words'] = $nf_words;
		// Score
		$r1['is_score'] = ((intval($wpfts_core->get_option('is_show_score')) != 0) && ($score > 0.001)) ? 1 : 0;
		$r1['score'] = $score;
		// Is Attachment
		$r1['is_attachment'] = $is_attachment;
		// Is Filesize
		$r1['is_filesize'] = intval($wpfts_core->get_option('is_filesize'));
		// Is Direct Link
		$r1['is_direct_link'] = intval($wpfts_core->get_option('is_direct_link'));
		// Filesize
		$r1['filesize'] = ($is_attachment) ? $filesize : 0;
		// Direct Link
		$r1['link'] = ($is_attachment) ? $file_link : '';
		$r1['is_demo'] = $this->demo_mode;

		$r1 = apply_filters('wpfts_se_data', $r1, $this->post);

		// Create an excerpt HTML
		$a = array();
		$a['excerpt_text'] = ($r1['is_excerpt_text']) ? '<div class="wpfts-smart-excerpt">'.$r1['excerpt_text'].'</div>' : '';
		$a['not_found_words'] = '';
		if (($r1['is_not_found_words']) && is_array($r1['not_found_words']) && (count($r1['not_found_words']) > 0)) {
			$nfs = array();
			foreach ($r1['not_found_words'] as $dd) {
				$nfs[] = '<s>'.$dd.'</s>';
			}
			$a['not_found_words'] = '<div class="wpfts-not-found"><span>'.__('Not found', 'fulltext-search').': '.implode(' ', $nfs).'</span></div>';
		}
		$a['score'] = '';
		if ($r1['is_score']) {
			$a['score'] = '<span class="wpfts-score">'.__('Score', 'fulltext-search').': '.number_format_i18n($r1['score'], 2).'</span>';
		}
		$a['link'] = '';
		if ($r1['is_attachment']) {
			$shift = (strlen($a['score']) > 0) ? ' wpfts-shift' : '';

			if ($r1['is_direct_link']) {
				$a['link'] = '<a class="wpfts-download-link'.$shift.'" href="'.esc_url($r1['link']).'"><span>'.__('Download', 'fulltext-search').( $r1['is_filesize'] ? ' ('.size_format(floatval($r1['filesize']), 2).')' : '').'</span></a>';
			} else {
				if ($r1['is_filesize']) {
					$a['link'] = '<span class="wpfts-file-size'.$shift.'">'.__('File Size', 'fulltext-search').': '.size_format(floatval($r1['filesize']), 2).'</span>';
				}
			}

		}
		$a['is_demo'] = $r1['is_demo'];

		$a = apply_filters('wpfts_se_output', $a, $this->post);

		$s = '';
		$s .= $a['excerpt_text'];
		$s .= $a['not_found_words'];
		if ((strlen($a['score']) > 0) || (strlen($a['link']) > 0)) {
			$s .= '<div class="wpfts-bottom-row">'.implode(' ', array($a['score'], $a['link'])).'</div>';
		}

		return $s;
	}


}