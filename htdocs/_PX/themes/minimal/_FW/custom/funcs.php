<?php

/**
 * テーマ独自の機能群
 */
class pxtheme_custom_funcs{

	private $px;

	/**
	 * コンストラクタ
	 */
	public function __construct( $px ){
		$this->px = $px;
		$this->px->path_theme_files();
	}//__construct()

	/**
	 * グローバルナビのカテゴリリストを取得
	 */
	public function get_gnavi_category_list(){
		$children = $this->px->site()->get_children('');//トップページの子階層を取得
		$rtn = array();
		foreach( $children as $row ){
			$page_info = $this->px->site()->get_page_info($row);
			if( !$page_info['category_top_flg'] ){
				continue;
			}
			array_push( $rtn, $row );
		}
		return $rtn;
	}

	/**
	 * グローバルナビのHTMLソースを生成
	 */
	public function mk_html_gnavi( $top_page_id, $depth = 0 ){
		if( $depth > 3 ){
			// 階層が深すぎる場合はスキップ
			//   ※この数値を変更すると、最大深度を変えられます。
			return '';
		}
		$rtn = '';

		$local_children = $this->px->site()->get_children( $top_page_id );
		if( count($local_children) ){
			$rtn .= '<ul>'."\n";
			foreach( $local_children as $local_child_page_id ){
				$local_child_page_info = $this->px->site()->get_page_info($local_child_page_id);
				$rtn .= '<li>';
				$rtn .= $this->px->theme()->mk_link($local_child_page_info['path']);
				if( $this->px->site()->is_page_in_breadcrumb( $local_child_page_info['id'] ) ){
					$rtn .= $this->mk_html_gnavi( $local_child_page_info['id'], $depth+1 );
				}//if
				$rtn .= '</li>'."\n";
			}//foreach 
			$rtn .= '</ul>'."\n";
		}//if

		return $rtn;
	}

	/**
	 * ショルダーナビのリストを取得
	 */
	public function get_shouldernavi_list(){
		$children = $this->px->site()->get_children('', array('filter'=>false));//トップページの子階層を取得
		$rtn = array();
		foreach( $children as $row ){
			$page_info = $this->px->site()->get_page_info($row);
			if( $page_info['category_top_flg'] ){
				continue;
			}
			array_push( $rtn, $row );
		}
		return $rtn;
	}

	/**
	 * パンくずのHTMLソースを生成する。
	 * @return HTML source
	 */
	public function mk_breadcrumb(){
		$args = func_get_args();
		$current_path = $this->px->req()->get_request_file_path();
		if(strlen($args[0])){
			//オプションで指定があれば、カレントページを仮定する。
			$current_path = $args[0];
		}
		$page_info = $this->px->site()->get_page_info($current_path);
		$page_info['logical_path'] = trim($page_info['logical_path']);
		if( $page_info['id'] == '' ){
			//  ホームの場合
			return '<ul><li><strong>'.t::h($this->px->site()->get_page_info('','title_breadcrumb')).'</strong></li></ul>';
		}
		$array_breadcrumb = explode('>',$page_info['logical_path']);
		if( !strlen( $page_info['logical_path'] ) ){
			$array_breadcrumb = array();
		}
		$rtn = '';
		$rtn .= '<ul>';
		$rtn .= '<li><a href="'.t::h($this->px->theme()->href('')).'">'.t::h($this->px->site()->get_page_info('','title_breadcrumb')).'</a></li>';
		foreach( $array_breadcrumb as $page_id ){
			$linkto_page_info = $this->px->site()->get_page_info($page_id);
			$href = $this->px->theme()->href($linkto_page_info['path']);
			if( $href == $current_path ){
				$rtn .= '<li> &gt; '.t::h($linkto_page_info['title_breadcrumb']).'</li>';
			}else{
				$rtn .= '<li> &gt; <a href="'.t::h($href).'">'.t::h($linkto_page_info['title_breadcrumb']).'</a></li>';
			}
		}
		$rtn .= '<li> &gt; <strong>'.t::h($page_info['title_breadcrumb']).'</strong></li>';
		$rtn .= '</ul>';
		return $rtn;
	}//mk_breadcrumb()

	/**
	 * デザインスキームを取得
	 */
	public function get_design_scheme(){
		$rtn = array();
		$rtn['layout.max_witdh'] = 1240;
		$rtn['layout.break_point'] = 590;
		$rtn['colors.main'] = $this->px->get_conf('colors.main');
		if(!strlen($rtn['colors.main'])){
			$rtn['colors.main'] = '#000000';
		}
		return $rtn;
	}

}

?>