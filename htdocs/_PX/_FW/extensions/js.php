<?php
$this->load_px_class('/bases/extension.php');

/**
 * 拡張子 *.js のextensionクラス
 */
class px_extensions_js extends px_bases_extension{

	/**
	 * コンテンツを実行し、結果出力されるソースを返す。
	 * @return string 出力ソース
	 */
	public function execute( $path_content ){
		@header('Content-type: text/javascript; charset=UTF-8');//デフォルトのヘッダー

		ob_start();
		$px = $this->px;
		@include( $path_content );
		$src = ob_get_clean();
		$src = $this->px->theme()->output_filter($src, 'js');
		print $src;
		return true;
	}

}

?>