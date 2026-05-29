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

class WPFTS_Htmltools
{
	static function makeNode($name, $attrs = array(), $html = false)
	{
		$s = '<'.$name.' ';
		foreach ($attrs as $k => $d) {
			$s .= ' '.htmlspecialchars($k).'="'.htmlspecialchars($d).'"';
		}
		
		if ($html !== false) {
			$s .= '>'.$html.'</'.$name.'>';
		} else {
			$s .= '/>';
		}
		
		return $s;
	}
	
	static function displaySelect($data, $current = false, $attrs = array())
	{
		echo wp_kses(self::makeSelect($data, $current, $attrs), array(
			'label' => array(
				'for' => array(),
			),
			'select' => array(
				'name' => array(),
				'id' => array(),
				'class' => array(),
				'style' => array(),
				'placeholder' => array(),
				'title' => array(),
				'multiple' => array(),
			),
			'option' => array(
				'value' => array(),
				'selected' => array(),
			),
		));
	}

	static function makeSelect($data, $current = false, $attrs = array())
	{
		$html = '';
		foreach ($data as $k => $v) {
			$html .= '<option value="'.htmlspecialchars($k).'" '.((($current !== false) && ($current == $k)) ? ' selected="selected"' : '').'>'.htmlspecialchars($v).'</option>';
		}
		
		return self::makeNode('select', $attrs, $html);
	}
	
	static function makeMultiSelect($data, $current = array(), $attrs = array())
	{
		$attrs['multiple'] = 'multiple';
		
		$html = '';
		foreach ($data as $k => $v) {
			$html .= '<option value="'.htmlspecialchars($k).'" '.((($current !== false) && (in_array($k, $current))) ? ' selected="selected"' : '').'>'.htmlspecialchars($v).'</option>';
		}
		
		return self::makeNode('select', $attrs, $html);
	}
	
	static function displayRadioGroup($basename, $data, $current = false, $attrs = array())
	{
		$kses = array(
			'label' => array(
				'for' => array(),
			),
			'span' => array(),
			'i' => array(),
			'p' => array(),
			'u' => array(),
			'b' => array(),
			'a' => array(
				'href' => array(),
				'title' => array(),
				'target' => array(),
			),
			'input' => array(
				'type' => array(),
				'value' => array(),
				'name' => array(),
				'id' => array(),
				'class' => array(),
				'style' => array(),
				'placeholder' => array(),
				'title' => array(),
				'checked' => array(),
			),
		);

		echo wp_kses(self::makeRadioGroup($basename, $data, $current, $attrs), $kses);
	}

	static function makeRadioGroup($basename, $data, $current = false, $attrs = array())
	{
		$html = '';
		
		if (is_array($data)) {
			$uniq = '';
			foreach ($data as $k => $d) {
				$id = 'rg'.$uniq.$basename.'_'.$k;
				$html .= '<label for="'.esc_attr($id).'"><input type="radio" name="'.esc_attr($basename).'" id="'.esc_attr($id).'" value="'.esc_attr($k).'"'.($current == $k ? ' checked="checked"' : '').'>&nbsp;'.esc_html($d).'</label>';
			}
		}
		
		return $html;
	}
	
	static function displayText($current = false, $attrs = array())
	{
		echo wp_kses(self::makeText($current, $attrs), array(
			'input' => array(
				'type' => array(),
				'value' => array(),
				'name' => array(),
				'id' => array(),
				'class' => array(),
				'style' => array(),
				'placeholder' => array(),
				'title' => array(),
				'checked' => array(),
			),
		));
	}

	static function makeText($current = false, $attrs = array())
	{
		$html = '';
		$attrs['type'] = 'text';
		if ($current !== false) {
			$attrs['value'] = $current;
		}
		return self::makeNode('input', $attrs, $html);
	}
	
	static function makeHidden($current = false, $attrs = array())
	{
		$html = '';
		$attrs['type'] = 'hidden';
		if ($current !== false) {
			$attrs['value'] = $current;
		}
		return self::makeNode('input', $attrs, $html);
	}
	
	static function makeTextarea($current = '', $attrs = array())
	{
		$html = htmlspecialchars($current);
		return self::makeNode('textarea', $attrs, $html);
	}
	
	static function displayButton($caption = '', $attrs = array())
	{
		echo wp_kses(self::makeButton($caption, $attrs), array(
			'button' => array(
				'type' => array(),
				'value' => array(),
				'name' => array(),
				'id' => array(),
				'class' => array(),
				'style' => array(),
				'placeholder' => array(),
				'title' => array(),
			),
		));
	}

	static function makeButton($caption = '', $attrs = array())
	{
		$html = $caption;
		return self::makeNode('button', $attrs, $html);
	}
	
	static function displayCheckbox($current = 0, $attrs = array(), $label = false)
	{
		echo wp_kses(self::makeCheckbox($current, $attrs, $label), array(
			'label' => array(
				'for' => array(),
			),
			'span' => array(),
			'i' => array(),
			'p' => array(),
			'u' => array(),
			'b' => array(),
			'a' => array(
				'href' => array(),
				'title' => array(),
				'target' => array(),
			),
			'input' => array(
				'type' => array(),
				'value' => array(),
				'name' => array(),
				'id' => array(),
				'class' => array(),
				'style' => array(),
				'placeholder' => array(),
				'title' => array(),
				'checked' => array(),
			),
		));
	}

	static function makeCheckbox($current = 0, $attrs = array(), $label = false)
	{
		if ($current) {
			$attrs['checked'] = 'checked';
		} else {
			if (isset($attrs['checked'])) {
				unset($attrs['checked']);
			}
		}
		$attrs['type'] = 'checkbox';
		
		$html = self::makeNode('input', $attrs).$label;
		if ($label !== false) {
			$l_attrs = array();
			if (isset($attrs['id'])) {
				$l_attrs['for'] = $attrs['id'];
			}
			return self::makeNode('label', $l_attrs, $html);
		} else {
			return $html;
		}
	}
	
	static function displayLabelledCheckbox($name, $value, $label, $ischecked = false, $attrs2 = array())
	{
		echo wp_kses(self::makeLabelledCheckbox($name, $value, $label, $ischecked, $attrs2), array(
			'label' => array(
				'for' => array(),
			),
			'span' => array(),
			'i' => array(),
			'p' => array(),
			'u' => array(),
			'b' => array(),
			'a' => array(
				'href' => array(),
				'title' => array(),
				'target' => array(),
			),
			'input' => array(
				'type' => array(),
				'value' => array(),
				'name' => array(),
				'id' => array(),
				'class' => array(),
				'style' => array(),
				'placeholder' => array(),
				'title' => array(),
				'checked' => array(),
			),
		));
	}

	static function makeLabelledCheckbox($name, $value, $label, $ischecked = false, $attrs2 = array())
	{
		$id = 'lch'.$name;
		
		$attrs = array(
			'type' => 'checkbox',
			'value' => $value,
			'name' => $name,
			'id' => $id,
		) + $attrs2;
		if ($ischecked) {
			$attrs['checked'] = 'checked';
		}
	
		$html = '<label for="'.$id.'">'.self::makeNode('input', $attrs).'&nbsp;<span>'.$label.'</span></label>';
		
		return $html;
	}

	static function displayBadgelistEditor($list, $selected, $attrs)
	{
		$class = isset($attrs['class']) ? $attrs['class'] : 'wpfts-badgelist-editor';
		$name = isset($attrs['name']) ? $attrs['name'] : 'wpfts_badgelist';

		$rand_id = 'wpfts_badge_editor_'.md5(microtime(true).uniqid('wpfts_badge_editor'));

		ob_start();
		?><div class="<?php echo esc_attr($class); ?>">
		<select name="<?php echo esc_attr($name); ?>" multiple="multiple" id="<?php echo esc_attr($rand_id); ?>">
		<?php
		$ks = array(
			'b' => array(),
			'i' => array(),
			'u' => array(),
			'span' => array(),
			'a' => array(
				'href' => array()
			),
		);
		foreach ($list as $k => $v) {
			?><option value="<?php echo esc_attr($k); ?>"<?php echo in_array($k, $selected) ? ' selected="selected"' : ''; ?>><?php echo wp_kses($v, $ks); ?></option>
			<?php
		}
		?>
		</select>
		<script type="text/javascript">
		jQuery(document).ready(function()
		{
			jQuery('#<?php echo esc_html($rand_id); ?>').select2({
				tags: true,
    			tokenSeparators: [',', ' '],
			});
		});
		</script>
		</div>
		<?php

		echo ob_get_clean();
	}

}