<?php
    class Download extends CI_Controller {
		public function index() {

			$ean = '123';

			$url = 'https://vdxl.im/3032163501053_a_en_r458.jpg';
			$url = 'https://i.ebayimg.com/00/s/MTAyNFgxMDAw/z/qmUAAOSwPdddLJm-/$_3.PNG';
			$url = 'https://mytoys.scene7.com/is/image/myToys/ext/4707461-01.jpg?$rtf_mt_prod-main_xl$';

			
			$image = file_get_contents($url);
			$finfo = new finfo(FILEINFO_MIME_TYPE);
			$mimetype = $finfo->buffer($image);


			$filename = FCPATH . 'img_spiele\\' . $ean . '.jpg';

			if($mimetype=='image/jpeg') {
				file_put_contents($filename, $image);
			} elseif ($mimetype=='image/png'){
				$image = imagecreatefrompng($url);
				$bg = imagecreatetruecolor(imagesx($image), imagesy($image));
				imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
				imagealphablending($bg, TRUE);
				imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
				imagedestroy($image);
				$quality = 75;
				imagejpeg($bg, $filename, $quality);
				imagedestroy($bg);
			} else {
				echo "Falsches Dateiformat: <b>$mimetype</b>. Nur jpeg- und png-Bilddateien sind erlaubt.";
			}
		}

	}
