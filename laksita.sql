/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.8-MariaDB-log : Database - db_softwarehouse
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `tb_blog` */

DROP TABLE IF EXISTS `tb_blog`;

CREATE TABLE `tb_blog` (
  `id_blog` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `title_en` varchar(50) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `content_en` text DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `id_blog_category` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_blog`),
  KEY `id_blog_category` (`id_blog_category`),
  CONSTRAINT `tb_blog_ibfk_1` FOREIGN KEY (`id_blog_category`) REFERENCES `tb_blog_category` (`id_blog_category`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_blog` */

insert  into `tb_blog`(`id_blog`,`title`,`title_en`,`content`,`content_en`,`image`,`id_blog_category`,`status`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Artikel 101',NULL,'<p>ini artikel dengan tanpa <b>header</b><p>halo</p><h1><img data-filename=\"product`.png\" style=\"width: 25%;\" src=\"http://localhost:8000/storage/image/blog/artikel/6041cfe92dad86.92426332.png\">gambar 1</h1><p><br></p><p><img data-filename=\"product.png\" style=\"width: 25%;\" src=\"http://localhost:8000/storage/image/blog/artikel/6041cfe931ab24.25193913.png\">gambar 2<br></p><p></p><p></p></p>\n',NULL,'assets/image/blog/thumbnail/Screenshot (586).png',10,0,'2021-03-05 06:30:01','2021-03-12 09:01:44','2021-03-12 09:01:44'),
(3,'Artikel 2',NULL,'<p>halo<p></p><p>halo - halo</p><p><br></p><p><br></p><p></p><p></p><p></p><p></p></p>\n',NULL,'assets/image/blog/thumbnail/1.jpg',2,1,'2021-03-05 12:36:47','2021-03-31 13:15:44','2021-03-31 13:15:44'),
(4,'Artikel 3',NULL,'<p>halp<p>halp</p><p>halp</p><p></p><p></p><p><br></p><p><img data-filename=\"product.png\" style=\"width: 50%;\" src=\"http://localhost:8000/storage/image/blog/artikel/Artikel%203/604236cedc0b48.35581914.png\"><br></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p></p>\n',NULL,'assets/image/blog/thumbnail/Screenshot (586).png',12,1,'2021-03-05 13:12:06','2021-03-31 13:15:48','2021-03-31 13:15:48'),
(5,'News 101',NULL,'<h1>Kumpulan gambar<p><br></p><p><img data-filename=\"product.png\" style=\"width: 25%;\" src=\"http://localhost:8000/storage/image/blog/artikel/News%20101/60434913877907.57639771.png\"></p><p><img data-filename=\"327794.jpg\" style=\"width: 25%;\" src=\"http://localhost:8000/storage/image/blog/artikel/News%20101/60434945a69d32.86642613.jpeg\"><br></p><p><br></p><p><br></p></h1>\n',NULL,'assets/image/blog/thumbnail/Screenshot (586).png',11,1,'2021-03-06 09:19:15','2021-03-31 13:15:55','2021-03-31 13:15:55'),
(6,'AA-AA',NULL,'<p>halo semua<p><span style=\'color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\'>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</span></p><p><span style=\'color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\'>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</span></p><p><span style=\'color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\'>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</span><span style=\'color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\'><br></span><span style=\'color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\'><br></span><br></p><p><img data-filename=\"1805551001_Pertemuan 4.png\" style=\"width: 50%;\" src=\"http://localhost:8000/storage/image/blog/artikel/AA-AA/604ae268963237.00102387.png\"></p><p><br></p><p><img data-filename=\"1805551001_Pertemuan 1.png\" style=\"width: 50%;\" src=\"http://localhost:8000/storage/image/blog/artikel/AA-AA/604ae2689db9b8.24156109.png\"><br></p><p></p></p>\n',NULL,'assets/image/blog/thumbnail/Screenshot (285).png',11,1,'2021-03-12 03:39:20','2021-03-31 13:15:40','2021-03-31 13:15:40'),
(7,'Kebutuhan Internet',NULL,'<p><br><p><img data-filename=\"_1.jpg\" style=\"width: 224px;\" src=\"http://localhost:8000/storage/image/blog/artikel/Kebutuhan%20Internet/604b330b059d85.44833277.jpeg\">internet saangat diperlukan saat ini dan seterusnya</p><p><br></p><p><img data-filename=\"Screenshot (586).png\" style=\"width: 50%;\" src=\"http://localhost:8000/storage/image/blog/artikel/Kebutuhan%20Internet/604b330b0a8cd7.57990362.png\"><br></p></p>\n',NULL,'assets/image/blog/thumbnail/Screenshot (612).png',11,1,'2021-03-12 09:23:23','2021-03-31 13:15:51','2021-03-31 13:15:51'),
(9,'A Blog','A Blog','<p>Konten Indonesia<p></p><p><img data-filename=\"vote.png\" style=\"width: 927.333px;\" src=\"http://localhost:8000/storage/image/blog/artikel/A%20Blog/605dfc79058db1.00057226.png\"><br></p><p></p><p><br></p><p><br></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p></p>\n','<p>content<br><p><img data-filename=\"gege.jpg\" style=\"width: 25%;\" src=\"http://localhost:8000/storage/image/blog/artikel/A%20Blog/605dfc790dfce0.55332527.jpeg\"><img data-filename=\"nayeon.jpg\" style=\"width: 50%;\" src=\"http://localhost:8000/storage/image/blog/artikel/A%20Blog/605dfc790f7c78.97726188.jpeg\"></p><p><br></p><p></p><p><br></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p></p>\n','assets/image/blog/thumbnail/1805551001_Pertemuan 1.png',1,1,'2021-03-26 14:47:16','2021-03-31 13:15:36','2021-03-31 13:15:36'),
(10,'Perbedaan Unicorn, Decacorn, dan Hectacorn','Perbedaan Unicorn, Decacorn, dan Hectacorn','<p style=\'line-height: 28px; font-family: \"Century Gothic\", sans-serif; color: rgb(114, 131, 154);\'>Debat Capres yang dihelat pada 17 Februari 2019 lalu menyinggung istilah yang masih agak asing di telinga orang awam, yaitu pertanyaan yang terlontar dari Capres nomor urut 1, Joko Widodo (Jokowi). Pada satu kesempatan, Jokowi melempar pertanyaan pada Prabowo Subianto mengenai dukungan untuk pengembangan Unicorn di Indonesia. Tapi seiring berjalannya waktu kita mulai mendengar decacorn dan hectocorn juga. Sebenarnya, apa sih perbedaan unicorn, decacorn, dan hectocorn?<p style=\'line-height: 28px; font-family: \"Century Gothic\", sans-serif; color: rgb(114, 131, 154);\'>Kalau kamu diberi pertanyaan serupa, jangan sampai kamu menjawab &acirc;&#128;&#156;yang online-online itu&acirc;&#128;&#157; ya. Sebab meski pada dasarnya bisnis-bisnis ini menggunakan koneksi internet alias online, tapi akan lebih tepat kalau kamu menggunakan istilah&nbsp;<em>&acirc;&#128;&#156;startup.&acirc;&#128;&#157; Startup</em>&nbsp;adalah perusahaan yang baru dirintis dan berada dalam fase pengembangan, biasanya masih seumur jagung dan sudah berbasis digital.</p><h2 style=\'font-family: \"Century Gothic\", sans-serif; line-height: 1.3; color: rgb(61, 81, 105);\'><span style=\"font-weight: bolder;\">Perbedaan Unicorn, Decacorn, dan Hectacorn</span></h2><p style=\'line-height: 28px; font-family: \"Century Gothic\", sans-serif; color: rgb(114, 131, 154);\'>Ketika sebuah perusahaan&nbsp;<em>startup&nbsp;</em>mulai meraih berbagai prestasi dan nilai valuasinya meningkat, akan ada beberapa &acirc;&#128;&#156;level yang diraih, yaitu:</p><div class=\"td-a-rec td-a-rec-id-content_inline td_block_template_13 td_uid_21_5e573f5ec64d5_rand\" style=\'color: rgb(61, 81, 105); font-family: \"Century Gothic\", sans-serif;\'>&nbsp;</div><h3 style=\'font-family: \"Century Gothic\", sans-serif; line-height: 1.3; color: rgb(61, 81, 105);\'><span style=\"font-weight: bolder;\">Unicorn</span></h3><p style=\'line-height: 28px; font-family: \"Century Gothic\", sans-serif; color: rgb(114, 131, 154);\'>Istilah Unicorn berasal dari spesies kuda putih mitologi dengan satu tanduk di dahi. Perusahaan bergelar Unicorn adalah bisnis yang nilai valuasinya sudah mencapai USD$ 1 juta atau setara Rp14 triliun. Hewan&nbsp;<em>unicorn</em>&nbsp;digunakan dalam konteks perusahaan&nbsp;<em>startup</em>&nbsp;karena sama seperti&nbsp;<em>unicorn</em>, kehadiran perusahaan&nbsp;<em>startup</em>&nbsp;yang dapat mencapai nilai valuasi sebesar US$1 miliar cukup langka dan terdengar agak mustahil.</p><p style=\'line-height: 28px; font-family: \"Century Gothic\", sans-serif; color: rgb(114, 131, 154);\'>Julukan ini diperkenalkan oleh Aileen Lee, pendiri perusahaan investasi Cowboy Ventures dalam artikelnya berjudul &acirc;&#128;&#156;<span style=\"color: rgb(0, 0, 128);\"><u><a href=\"https://techcrunch.com/2013/11/02/welcome-to-the-unicorn-club/\" style=\"color: rgb(16, 24, 48); line-height: 1.3; outline: none;\">Welcome to the Union Club: Learning from Billion-Dollar Startups.</a></u></span>&acirc;&#128;&#157; Di Indonesia, rasa mustahil akan perusahaan Unicorn perlahan mulai menghilang, mengingat beberapa perusahaan terkenal sudah mencapai peringkat ini, seperti Tokopedia, Traveloka, Bukalapak, dan OVO. Setelah mencapai level Unicorn, perusahaan-perusahaan ini akan melangkah ke level selanjutnya, Decacorn.</p><h3 style=\'font-family: \"Century Gothic\", sans-serif; line-height: 1.3; color: rgb(61, 81, 105);\'><span style=\"font-weight: bolder;\">Decacorn</span></h3><p style=\'line-height: 28px; font-family: \"Century Gothic\", sans-serif; color: rgb(114, 131, 154);\'>Decacorn adalah gabungan dari kata &acirc;&#128;&#156;deka&acirc;&#128;&#157; (bahasa Yunani) yang berarti angka 10 ditambah akhiran dari &acirc;&#128;&#156;Unicorn.&acirc;&#128;&#157; Sesuai namanya, perusahaan berlevel Decacorn adalah perusahaan yang mempunyai nilai valuasi 10 kali lipat dari Unicorn, yaitu sebesar US$10 miliar. Beberapa perusahaan Asia yang sudah mencapai level ini adalah Toutiau (Bytedance), DJI Innovations, Grab, dan tujuh perusahaan lain.</p><p style=\'line-height: 28px; font-family: \"Century Gothic\", sans-serif; color: rgb(114, 131, 154);\'>Tak mau kalah, Indonesia juga mempunyai perusahaan bergelar Decacorn. Berdasarkan data dari&nbsp;<a href=\"https://www.cbinsights.com/research-unicorn-companies\" style=\"color: rgb(16, 24, 48); line-height: 1.3; outline: none;\">CBInsight Real Time Unicorn Tracker</a>&nbsp;pada tahun 2019, Gojek menjadi perusahaan pertama di Indonesia yang berhasil mencapai level ini. Perusahaan&nbsp;<em>marketplace</em>, Tokopedia, diharapkan dapat menyusul kesuksesan Gojek mencapai gelar Decacorn pada 2020.</p><h3 style=\'font-family: \"Century Gothic\", sans-serif; line-height: 1.3; color: rgb(61, 81, 105);\'><span style=\"font-weight: bolder;\">Hectocorn</span></h3><p style=\'line-height: 28px; font-family: \"Century Gothic\", sans-serif; color: rgb(114, 131, 154);\'>Hectocorn menduduki dua level lebih tinggi dari Unicorn, yang artinya gelar ini disematkan pada perusahaan yang nilai valuasinya sudah mencapai US$100 miliar. Meski ada begitu banyak perusahaan yang nilai valuasinya sudah jauh melebihi US$100 miliar, namun gelar Hectocorn tidak dapat disematkan bagi mereka. Pasalnya, Hectocorn hanya bisa didapat jika perusahaan tersebut masih rintisan, alias&nbsp;<em>startup</em>&nbsp;yang sebenarnya masih dalam tahap pengembangan.</p><p style=\'line-height: 28px; font-family: \"Century Gothic\", sans-serif; color: rgb(114, 131, 154);\'>Saat ini, Indonesia belum mempunyai perusahaan setingkat Hectocorn. Dari seluruh dunia, gelar Hectocorn hanya dimiliki oleh satu perusahaan, yaitu Ant Financial yang dulunya dikenal sebagai Alipay, perusahaan teknologi finansial (<em>fintech</em>) yang berafiliasi dengan Alibaba Group. Melihat sulitnya perusahaan mencapai gelar Hectocorn, Menteri Komunikasi dan Informatika, Johnny G. Plate, berniat memotivasi bisnis-bisnis&nbsp;<em>startup</em>&nbsp;untuk segera mencapai level Unicorn hingga Hectocorn demi mempercepat peningkatan strata ekonomi digital di Indonesia.</p></p>\n','<p style=\'line-height: 28px; font-family: \"Century Gothic\", sans-serif; color: rgb(114, 131, 154);\'>Debat Capres yang dihelat pada 17 Februari 2019 lalu menyinggung istilah yang masih agak asing di telinga orang awam, yaitu pertanyaan yang terlontar dari Capres nomor urut 1, Joko Widodo (Jokowi). Pada satu kesempatan, Jokowi melempar pertanyaan pada Prabowo Subianto mengenai dukungan untuk pengembangan Unicorn di Indonesia. Tapi seiring berjalannya waktu kita mulai mendengar decacorn dan hectocorn juga. Sebenarnya, apa sih perbedaan unicorn, decacorn, dan hectocorn?<p style=\'line-height: 28px; font-family: \"Century Gothic\", sans-serif; color: rgb(114, 131, 154);\'>Kalau kamu diberi pertanyaan serupa, jangan sampai kamu menjawab &acirc;&#128;&#156;yang online-online itu&acirc;&#128;&#157; ya. Sebab meski pada dasarnya bisnis-bisnis ini menggunakan koneksi internet alias online, tapi akan lebih tepat kalau kamu menggunakan istilah&nbsp;<em>&acirc;&#128;&#156;startup.&acirc;&#128;&#157; Startup</em>&nbsp;adalah perusahaan yang baru dirintis dan berada dalam fase pengembangan, biasanya masih seumur jagung dan sudah berbasis digital.</p><h2 style=\'font-family: \"Century Gothic\", sans-serif; line-height: 1.3; color: rgb(61, 81, 105);\'><span style=\"font-weight: bolder;\">Perbedaan Unicorn, Decacorn, dan Hectacorn</span></h2><p style=\'line-height: 28px; font-family: \"Century Gothic\", sans-serif; color: rgb(114, 131, 154);\'>Ketika sebuah perusahaan&nbsp;<em>startup&nbsp;</em>mulai meraih berbagai prestasi dan nilai valuasinya meningkat, akan ada beberapa &acirc;&#128;&#156;level yang diraih, yaitu:</p><div class=\"td-a-rec td-a-rec-id-content_inline td_block_template_13 td_uid_21_5e573f5ec64d5_rand\" style=\'color: rgb(61, 81, 105); font-family: \"Century Gothic\", sans-serif;\'>&nbsp;</div><h3 style=\'font-family: \"Century Gothic\", sans-serif; line-height: 1.3; color: rgb(61, 81, 105);\'><span style=\"font-weight: bolder;\">Unicorn</span></h3><p style=\'line-height: 28px; font-family: \"Century Gothic\", sans-serif; color: rgb(114, 131, 154);\'>Istilah Unicorn berasal dari spesies kuda putih mitologi dengan satu tanduk di dahi. Perusahaan bergelar Unicorn adalah bisnis yang nilai valuasinya sudah mencapai USD$ 1 juta atau setara Rp14 triliun. Hewan&nbsp;<em>unicorn</em>&nbsp;digunakan dalam konteks perusahaan&nbsp;<em>startup</em>&nbsp;karena sama seperti&nbsp;<em>unicorn</em>, kehadiran perusahaan&nbsp;<em>startup</em>&nbsp;yang dapat mencapai nilai valuasi sebesar US$1 miliar cukup langka dan terdengar agak mustahil.</p><p style=\'line-height: 28px; font-family: \"Century Gothic\", sans-serif; color: rgb(114, 131, 154);\'>Julukan ini diperkenalkan oleh Aileen Lee, pendiri perusahaan investasi Cowboy Ventures dalam artikelnya berjudul &acirc;&#128;&#156;<span style=\"color: rgb(0, 0, 128);\"><u><a href=\"https://techcrunch.com/2013/11/02/welcome-to-the-unicorn-club/\" style=\"color: rgb(16, 24, 48); line-height: 1.3; outline: none;\">Welcome to the Union Club: Learning from Billion-Dollar Startups.</a></u></span>&acirc;&#128;&#157; Di Indonesia, rasa mustahil akan perusahaan Unicorn perlahan mulai menghilang, mengingat beberapa perusahaan terkenal sudah mencapai peringkat ini, seperti Tokopedia, Traveloka, Bukalapak, dan OVO. Setelah mencapai level Unicorn, perusahaan-perusahaan ini akan melangkah ke level selanjutnya, Decacorn.</p><h3 style=\'font-family: \"Century Gothic\", sans-serif; line-height: 1.3; color: rgb(61, 81, 105);\'><span style=\"font-weight: bolder;\">Decacorn</span></h3><p style=\'line-height: 28px; font-family: \"Century Gothic\", sans-serif; color: rgb(114, 131, 154);\'>Decacorn adalah gabungan dari kata &acirc;&#128;&#156;deka&acirc;&#128;&#157; (bahasa Yunani) yang berarti angka 10 ditambah akhiran dari &acirc;&#128;&#156;Unicorn.&acirc;&#128;&#157; Sesuai namanya, perusahaan berlevel Decacorn adalah perusahaan yang mempunyai nilai valuasi 10 kali lipat dari Unicorn, yaitu sebesar US$10 miliar. Beberapa perusahaan Asia yang sudah mencapai level ini adalah Toutiau (Bytedance), DJI Innovations, Grab, dan tujuh perusahaan lain.</p><p style=\'line-height: 28px; font-family: \"Century Gothic\", sans-serif; color: rgb(114, 131, 154);\'>Tak mau kalah, Indonesia juga mempunyai perusahaan bergelar Decacorn. Berdasarkan data dari&nbsp;<a href=\"https://www.cbinsights.com/research-unicorn-companies\" style=\"color: rgb(16, 24, 48); line-height: 1.3; outline: none;\">CBInsight Real Time Unicorn Tracker</a>&nbsp;pada tahun 2019, Gojek menjadi perusahaan pertama di Indonesia yang berhasil mencapai level ini. Perusahaan&nbsp;<em>marketplace</em>, Tokopedia, diharapkan dapat menyusul kesuksesan Gojek mencapai gelar Decacorn pada 2020.</p><h3 style=\'font-family: \"Century Gothic\", sans-serif; line-height: 1.3; color: rgb(61, 81, 105);\'><span style=\"font-weight: bolder;\">Hectocorn</span></h3><p style=\'line-height: 28px; font-family: \"Century Gothic\", sans-serif; color: rgb(114, 131, 154);\'>Hectocorn menduduki dua level lebih tinggi dari Unicorn, yang artinya gelar ini disematkan pada perusahaan yang nilai valuasinya sudah mencapai US$100 miliar. Meski ada begitu banyak perusahaan yang nilai valuasinya sudah jauh melebihi US$100 miliar, namun gelar Hectocorn tidak dapat disematkan bagi mereka. Pasalnya, Hectocorn hanya bisa didapat jika perusahaan tersebut masih rintisan, alias&nbsp;<em>startup</em>&nbsp;yang sebenarnya masih dalam tahap pengembangan.</p><p style=\'line-height: 28px; font-family: \"Century Gothic\", sans-serif; color: rgb(114, 131, 154);\'>Saat ini, Indonesia belum mempunyai perusahaan setingkat Hectocorn. Dari seluruh dunia, gelar Hectocorn hanya dimiliki oleh satu perusahaan, yaitu Ant Financial yang dulunya dikenal sebagai Alipay, perusahaan teknologi finansial (<em>fintech</em>) yang berafiliasi dengan Alibaba Group. Melihat sulitnya perusahaan mencapai gelar Hectocorn, Menteri Komunikasi dan Informatika, Johnny G. Plate, berniat memotivasi bisnis-bisnis&nbsp;<em>startup</em>&nbsp;untuk segera mencapai level Unicorn hingga Hectocorn demi mempercepat peningkatan strata ekonomi digital di Indonesia.</p></p>\n','assets/image/blog/thumbnail/blog.png',18,1,'2021-04-01 15:41:37','2021-04-01 16:21:05',NULL);

/*Table structure for table `tb_blog_category` */

DROP TABLE IF EXISTS `tb_blog_category`;

CREATE TABLE `tb_blog_category` (
  `id_blog_category` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `name_en` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_blog_category`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_blog_category` */

insert  into `tb_blog_category`(`id_blog_category`,`name`,`name_en`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Integrasi DAta',NULL,'2021-03-05 15:45:40','2021-03-31 13:16:08','2021-03-31 13:16:08'),
(2,'Entitas Database',NULL,'2021-03-05 15:46:34','2021-03-31 13:16:05','2021-03-31 13:16:05'),
(3,'AI2',NULL,'2021-03-05 15:49:54','2021-03-12 03:22:13','2021-03-12 03:22:13'),
(8,'Kecerdasan Tiruan',NULL,'2021-03-05 15:54:55','2021-03-31 13:16:22','2021-03-31 13:16:22'),
(9,'Pemrograman Mobile',NULL,'2021-03-05 15:57:48','2021-03-31 13:16:27','2021-03-31 13:16:27'),
(10,'Teknologi Masakini',NULL,'2021-03-05 15:59:19','2021-03-31 13:16:34','2021-03-31 13:16:34'),
(11,'Kebutuhan TI',NULL,'2021-03-05 16:01:58','2021-03-31 13:16:18','2021-03-31 13:16:18'),
(12,'Teknologi Informasi',NULL,'2021-03-05 16:02:48','2021-03-31 13:16:31','2021-03-31 13:16:31'),
(13,'Kebutuhan Ekonomi dengan TI',NULL,'2021-03-05 16:05:30','2021-03-31 13:16:15','2021-03-31 13:16:15'),
(14,'Network Operating System',NULL,'2021-03-05 16:06:15','2021-03-31 13:16:25','2021-03-31 13:16:25'),
(15,'Kateogri tambahan',NULL,'2021-03-06 09:16:24','2021-03-31 13:16:11','2021-03-31 13:16:11'),
(16,'Artificial Inelegent',NULL,'2021-03-12 03:20:51','2021-03-31 13:16:02','2021-03-31 13:16:02'),
(17,'Teknologi Terbaru',NULL,'2021-03-26 13:59:51','2021-03-31 13:16:36','2021-03-31 13:16:36'),
(18,'Marketing','Marketing','2021-04-01 15:39:50','2021-04-01 15:39:50',NULL);

/*Table structure for table `tb_detail_blog_category` */

DROP TABLE IF EXISTS `tb_detail_blog_category`;

CREATE TABLE `tb_detail_blog_category` (
  `id_detail_blog_category` int(11) NOT NULL AUTO_INCREMENT,
  `id_blog` int(11) DEFAULT NULL,
  `id_blog_category` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_detail_blog_category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_detail_blog_category` */

/*Table structure for table `tb_detail_blog_image` */

DROP TABLE IF EXISTS `tb_detail_blog_image`;

CREATE TABLE `tb_detail_blog_image` (
  `id_blog_image` int(11) NOT NULL AUTO_INCREMENT,
  `id_blog` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `type_content` enum('id','en') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_blog_image`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_detail_blog_image` */

insert  into `tb_detail_blog_image`(`id_blog_image`,`id_blog`,`image`,`type_content`,`created_at`,`updated_at`) values 
(7,4,'/image/blog/artikel/Artikel 3/604236cedc0b48.35581914.png','id','2021-03-05 13:49:02','2021-03-05 13:49:02'),
(8,5,'/image/blog/artikel/News 101/60434913877907.57639771.png','id','2021-03-06 09:19:15','2021-03-06 09:19:15'),
(10,5,'/image/blog/artikel/News 101/60434945a69d32.86642613.jpeg','id','2021-03-06 09:20:05','2021-03-06 09:20:05'),
(11,6,'/image/blog/artikel/AA-AA/604ae268963237.00102387.png','id','2021-03-12 03:39:20','2021-03-12 03:39:20'),
(12,6,'/image/blog/artikel/AA-AA/604ae2689db9b8.24156109.png','id','2021-03-12 03:39:20','2021-03-12 03:39:20'),
(13,7,'/image/blog/artikel/Kebutuhan Internet/604b330b059d85.44833277.jpeg','id','2021-03-12 09:23:23','2021-03-12 09:23:23'),
(14,7,'/image/blog/artikel/Kebutuhan Internet/604b330b0a8cd7.57990362.png','id','2021-03-12 09:23:23','2021-03-12 09:23:23'),
(19,8,'/image/blog/artikel/Blog Title Indo/605df2bf0b3d43.13280016.jpeg','en','2021-03-26 14:42:07','2021-03-26 14:42:07'),
(35,9,'/image/blog/artikel/A Blog/605dfc79058db1.00057226.png','id','2021-03-26 15:23:37','2021-03-26 15:23:37'),
(36,9,'/image/blog/artikel/A Blog/605dfc790dfce0.55332527.jpeg','en','2021-03-26 15:23:37','2021-03-26 15:23:37'),
(37,9,'/image/blog/artikel/A Blog/605dfc790f7c78.97726188.jpeg','en','2021-03-26 15:23:37','2021-03-26 15:23:37');

/*Table structure for table `tb_detail_expertise` */

DROP TABLE IF EXISTS `tb_detail_expertise`;

CREATE TABLE `tb_detail_expertise` (
  `id_detail_expertise` tinyint(4) NOT NULL AUTO_INCREMENT,
  `id_project` tinyint(4) DEFAULT NULL,
  `id_expertise` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_detail_expertise`),
  KEY `id_expertise` (`id_expertise`),
  KEY `id_project` (`id_project`),
  CONSTRAINT `tb_detail_expertise_ibfk_1` FOREIGN KEY (`id_expertise`) REFERENCES `tb_expertise` (`id_expertise`),
  CONSTRAINT `tb_detail_expertise_ibfk_2` FOREIGN KEY (`id_project`) REFERENCES `tb_project` (`id_project`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_detail_expertise` */

insert  into `tb_detail_expertise`(`id_detail_expertise`,`id_project`,`id_expertise`,`created_at`,`updated_at`,`deleted_at`) values 
(11,3,1,'2021-03-05 04:41:01','2021-03-05 04:41:01',NULL),
(12,3,2,'2021-03-05 04:41:01','2021-03-05 04:41:01',NULL),
(14,5,1,'2021-03-05 04:42:00','2021-03-05 04:42:00',NULL),
(15,5,2,'2021-03-05 04:42:00','2021-03-05 04:42:00',NULL),
(16,4,1,'2021-03-05 07:34:10','2021-03-05 07:34:10',NULL),
(17,6,1,'2021-03-26 13:52:22','2021-03-26 13:52:22',NULL),
(18,1,2,'2021-03-26 13:53:49','2021-03-26 13:53:49',NULL),
(19,7,3,'2021-03-31 16:22:55','2021-03-31 16:22:55',NULL);

/*Table structure for table `tb_expertise` */

DROP TABLE IF EXISTS `tb_expertise`;

CREATE TABLE `tb_expertise` (
  `id_expertise` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `description_en` text DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_expertise`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_expertise` */

insert  into `tb_expertise`(`id_expertise`,`name`,`description`,`description_en`,`image`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Web Developer','this caption is for description this caption is for description  this caption is for description  this caption is for description',NULL,'assets/image/expertise/usecase.png','2021-02-27 07:26:30','2021-03-31 13:09:54','2021-03-31 13:09:54'),
(2,'Mobile APP Developer','this caption is for description this caption is for description this caption is for description this caption is for description',NULL,'assets/image/expertise/product.png','2021-02-27 07:51:16','2021-03-31 13:09:50','2021-03-31 13:09:50'),
(3,'Software Development','Pengembangan perangkat lunak adalah proses memahami, menentukan, merancang, memprogram, mendokumentasikan, menguji, dan memperbaiki bug yang terlibat dalam pembuatan dan pemeliharaan.','Software development is the process of conceiving, specifying, designing, programming, documenting, testing, and bug fixing involved in creating and maintaining applications, frameworks, or other software components.','assets/image/expertise/software_dev.jpg','2021-03-31 13:38:15','2021-04-05 11:16:23',NULL),
(4,'IT Consultant','Konsultan IT bekerja dalam kemitraan dengan klien, menasihati mereka bagaimana menggunakan teknologi informasi untuk memenuhi tujuan bisnis mereka atau mengatasi masalah.','IT consultant is to work in partnership with clients, advising them how to use information technology in order to meet their business objectives or overcome problems.','assets/image/expertise/consult.jpg','2021-03-31 13:56:37','2021-04-05 11:15:51',NULL);

/*Table structure for table `tb_menu` */

DROP TABLE IF EXISTS `tb_menu`;

CREATE TABLE `tb_menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `id_page` int(11) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_menu`),
  KEY `id_page` (`id_page`),
  CONSTRAINT `tb_menu_ibfk_1` FOREIGN KEY (`id_page`) REFERENCES `tb_page` (`id_page`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_menu` */

insert  into `tb_menu`(`id_menu`,`name`,`id_page`,`url`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Additional Menu1',2,NULL,'2021-04-05 07:22:09','2021-04-05 09:39:51','2021-04-05 17:46:09'),
(2,'Menu 2',NULL,'https://www.laksitastartup.com/','2021-04-05 07:38:18','2021-04-05 09:28:06','2021-04-05 09:28:06'),
(4,'Product',NULL,'/product','2021-04-05 08:51:17','2021-04-05 08:51:17',NULL),
(5,'Project',NULL,'/project','2021-04-05 08:52:19','2021-04-05 08:52:19',NULL),
(6,'Demo Project',NULL,'/demo','2021-04-05 08:52:55','2021-04-05 08:52:55',NULL),
(7,'News',NULL,'/news','2021-04-05 08:53:27','2021-04-05 08:53:27',NULL),
(8,'Menu tambahan 1',2,NULL,'2021-04-10 11:01:34','2021-04-22 14:19:33','2021-04-22 14:19:33');

/*Table structure for table `tb_page` */

DROP TABLE IF EXISTS `tb_page`;

CREATE TABLE `tb_page` (
  `id_page` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `title_en` varchar(50) DEFAULT NULL,
  `content_en` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_page`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_page` */

insert  into `tb_page`(`id_page`,`title`,`content`,`title_en`,`content_en`,`created_at`,`updated_at`,`deleted_at`) values 
(2,'Page 1','<p>Page ini hanya untuk kebutuhan menu dan sub menu <b>2</b><p><img data-filename=\"product.png\" style=\"width: 25%;\" src=\"http://localhost:8000/storage/image/page/Page%201/ina/606aa4eab058d1.12871722.png\"><br></p><p></p><p></p></p>\n','Page 1','<p>This content just for fun 3<p><img data-filename=\"blog.png\" style=\"width: 696px;\" src=\"http://localhost:8000/storage/image/page/Page%201/ina/606a9e890ca873.13507062.png\"><br></p><p></p></p>\n','2021-04-05 05:22:17','2021-04-05 05:51:49',NULL);

/*Table structure for table `tb_page_image` */

DROP TABLE IF EXISTS `tb_page_image`;

CREATE TABLE `tb_page_image` (
  `id_page_image` int(11) NOT NULL AUTO_INCREMENT,
  `id_page` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `type_content` enum('id','en') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_page_image`),
  KEY `id_page` (`id_page`),
  CONSTRAINT `tb_page_image_ibfk_1` FOREIGN KEY (`id_page`) REFERENCES `tb_page` (`id_page`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_page_image` */

insert  into `tb_page_image`(`id_page_image`,`id_page`,`image`,`type_content`,`created_at`,`updated_at`,`deleted_at`) values 
(2,2,'/image/page/Page 1/ina/606a9e890ca873.13507062.png','en','2021-04-05 05:22:17','2021-04-05 05:22:17',NULL),
(3,2,'/image/page/Page 1/ina/606aa4eab058d1.12871722.png','id','2021-04-05 05:49:30','2021-04-05 05:49:30',NULL);

/*Table structure for table `tb_preference` */

DROP TABLE IF EXISTS `tb_preference`;

CREATE TABLE `tb_preference` (
  `id_preference` tinyint(4) NOT NULL AUTO_INCREMENT,
  `web_name` varchar(50) DEFAULT NULL,
  `logo_img` varchar(255) DEFAULT NULL,
  `banner_content_ina` text DEFAULT NULL,
  `banner_content_eng` text DEFAULT NULL,
  `address_ina` text DEFAULT NULL,
  `address_eng` text DEFAULT NULL,
  `banner_img` varchar(255) DEFAULT NULL,
  `link_video` varchar(255) DEFAULT NULL,
  `video_description_in` text DEFAULT NULL,
  `video_description_en` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_preference`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_preference` */

insert  into `tb_preference`(`id_preference`,`web_name`,`logo_img`,`banner_content_ina`,`banner_content_eng`,`address_ina`,`address_eng`,`banner_img`,`link_video`,`video_description_in`,`video_description_en`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Laksita Emi Saguna','assets/image/preference/-1eart.jpg','<p><b>Sistem Informasi Universitas Terintegrasi (SRUTI)</b></p><p>SRUTI membawa Misi menata dan memperkuat Tata Kelola Universitas, pendukung utama dalam penerapan isu - isu Trasparansi dan Akuntabilitas.</p>','<p><b>Integrated University Information System (SRUTI)</b></p><p>SRUTI carries the mission of organizing and strengthening University Governance, the main supporter of the implementation of transparency and accountability issues.<br></p>','<p style=\"text-align: left;\"><b>Start Up - Software Development Consultant</b></p><p style=\"text-align: left;\">Jl. Gunung Indrakita Ujung I No. 11</p><p style=\"text-align: left;\">Monang Maning</p><p style=\"text-align: left;\"><i class=\"fa fa-phone\"></i>081936653336</p><p style=\"text-align: left;\"><i class=\"fa fa-phone\"></i>08155735367<br></p><p style=\"text-align: left;\"><br></p><p style=\"text-align: left;\"><br></p><p style=\"text-align: left;\"><br></p><p><br></p>','<p style=\"text-align: left;\"><span style=\"font-weight: bolder;\">Start Up - Software Development Consultant</span></p><p style=\"text-align: left;\">Gunung Indrakita Ujung I street number 11</p><p style=\"text-align: left;\">Monang Maning</p><p><i class=\"fa fa-phone\"></i>081936653336</p><p><i class=\"fa fa-phone\"></i>08155735367</p><p><br></p>','assets/image/preference/-1eart.jpg','https://www.youtube.com/watch?v=fEx-N55-G_8','Sistem Informasi Universitas Terintegrasi (SRUTI) SRUTI membawa Misi menata dan memperkuat Tata Kelola Universitas, pendukung utama dalam penerapan isu - isu Trasparansi dan Akuntabilitas.','Integrated University Information System (SRUTI) SRUTI carries the mission of organizing and strengthening University Governance, the main supporter of the implementation of transparency and accountability issues.','2021-03-19 00:20:00','2021-04-22 14:26:20',NULL);

/*Table structure for table `tb_product` */

DROP TABLE IF EXISTS `tb_product`;

CREATE TABLE `tb_product` (
  `id_product` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(25) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `description_en` text DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_product`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_product` */

insert  into `tb_product`(`id_product`,`title`,`description`,`description_en`,`image`,`url`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'SIM Menara1','ini deskripsi yang panjang ini deskripsi yang panjang ini deskripsi yang panjang ini deskripsi yang panjang ini deskripsi yang panjang ini deskripsi yang panjang','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','assets/image/product/g1.PNG','https://www.menara.com','2021-02-25 14:16:34','2021-03-31 13:10:57','2021-03-31 13:10:57'),
(2,'SIM Perpustakaan','ini deskripsi yang panjang ini deskripsi yang panjang ini deskripsi yang panjang ini deskripsi yang panjang ini deskripsi yang panjang ini deskripsi yang panjang','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','assets/image/product/_1.jpg','https://www.perpustakaan.com','2021-02-26 04:34:07','2021-03-31 13:11:00','2021-03-31 13:11:00'),
(3,'SIM Koperasi','ini deskripsi yang panjang ini deskripsi yang panjang ini deskripsi yang panjang ini deskripsi yang panjang ini deskripsi yang panjang ini deskripsi yang panjang','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','assets/image/product/002.png','https://www.koperasi.com','2021-02-26 05:26:16','2021-03-31 13:10:53','2021-03-31 13:10:53'),
(4,'SIM Sekolah','Ini Sekolah Ini Sekolah Ini Sekolah Ini Sekolah','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','assets/image/product/fig2.jpeg','https://www.sekolah.com','2021-02-26 05:27:55','2021-03-31 13:11:03','2021-03-31 13:11:03'),
(5,'SIM Semarapura','ini deskirpsi ini deskirpsi  ini deskirpsi ini deskirpsi ini deskirpsi ini deskirpsi ini deskirpsi ini deskirpsi','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','assets/image/product/-1eart.jpg','https://www.semarapura.com','2021-02-26 08:12:30','2021-03-31 13:11:06','2021-03-31 13:11:06'),
(6,'Produk 1','Indo \"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','assets/image/product/1805551001_Pertemuan 1.png','https://produk1.com','2021-03-26 13:37:08','2021-03-31 13:10:50','2021-03-31 13:10:50'),
(7,'ASTA MANIK','Aplikasi terintegrasi manajemen akademik adalah aplikasi terintegerasi manajemen akademik yang mengatur seluruh proses akademik yang ada  mulai dari manajemen master data, manajemen matakuliah dan kurikulum, transaksi akademik persemester, dan transaksi akademik mahasiswa.','Academic management integrated application','assets/image/product/book1.png','https://www.laksitastartup.com/','2021-03-31 15:46:19','2021-04-22 10:47:08',NULL),
(8,'ASTA BAYU','Aplikasi terintegrasi bayar uang kuliah merupakan aplikasi manajemen pembayaran UKT, SPP, dan biaya perkuliahan lainnya. ASTA BAYU memfasilitasi langsung dengan salah satu bank nasional sehingga memudahkan mahasiswa dalam melakukan pembayaran.','Integrated application to pay tuition fees','assets/image/product/asta-bayu.jpg','https://www.laksitastartup.com/','2021-03-31 15:53:57','2021-04-22 10:45:02',NULL),
(9,'ASWIN','Aplikasi wisuda online merupakan aplikasi manajemen yang mengatur seluruh proses dan tahapan widuda. Aswin terdiri dari menu setting periode wisuda, pengaturan gelar, pengaturan penandatangan ijazah, manajemen syarat dan validasi syarat wisuda, hingga pencetakan ijazah dan skpi mahasiswa.','Online graduation application','assets/image/product/graduation.png','https://www.laksitastartup.com/','2021-03-31 16:00:52','2021-04-22 10:50:39',NULL),
(10,'ASTA KALI','Aplikasi perpustakaan online merupakan aplikasi yang memudahkan dalam menangani pengelolaan pustaka pada perpustakaan, peminjaman buku, dan pencatatan kunjungan perpustakaan baik secara fisik maupun online.','Online library appliccation','assets/image/product/asta-kali.jpg','https://www.laksitastartup.com/','2021-03-31 16:04:25','2021-04-22 10:48:40',NULL),
(11,'SAMA WEDA','Sistem Manajemen Website Terintegrasi merupakan aplikasi manajemen yang mengatur dan mengelola konten atau isi dari website universitas. Selain konten, samadewa dapat mengatur profil dari universitas hingga menambahkan pengumuman yang ingin ditampilkan dalam website.','Integrated Website Management System','assets/image/product/sama-weda.png','https://www.laksitastartup.com/','2021-03-31 16:12:58','2021-04-22 10:52:36',NULL),
(12,'SMRTI','Sistem manajemen registrasi terintegrasi memfasilitasi proses pendaftaran dan verifikasi mahasiswa baru, terintegrasi dengan sistem akademik dan pembayaran uang kuliah yang memungkinkan mahasiswa untuk dapat langsung mengisi KRS segera setelah diterima di perguruan tinggi.','Integrated registration management system','assets/image/product/smrti.jpg','https://www.laksitastartup.com/','2021-03-31 16:15:27','2021-04-22 10:54:53',NULL),
(13,'SENAPATI','Skripsi, Kuliah Kerja Nyata dan Kerja Praktik merupakan aplikasi yang bertugas dalam memanajemen proses pengajuan skripsi mahasiswa, proses pendaftaran hingga pemberian nilai terkait Kuliah Kerja Nyata dan Kerja Praktik yang dilakukan mahasiswa','Application of Skripsi, KKN and KP','assets/image/product/graduation.png','https://www.laksitastartup.com/','2021-03-31 16:17:03','2021-04-22 11:05:33',NULL),
(14,'SIMBKD','Sistem Informasi Manajemen Beban Kerja Dosen merupakan sistem yangn tidak hanya berfunsi untuk mencatat kinerja dosen dalam bidang Tri Darma Perguruan Tinggi, tetapi juga mengelola biodata dosen dan riwayat pekerjaan dosen.','Lecturer Workload Management Information System','assets/image/product/asta-kali.jpg','https://www.laksitastartup.com/','2021-04-22 11:12:26','2021-04-22 11:12:26',NULL),
(15,'SIMDOS','Sistem Informasi Manajemen Dosen merupakan sistem yang tidak hanya berfungsi sebagai pencatatan profil dan riwayat profesi dosen, tetapi juga berperan  sebagai sistem yang merekam kinerja dosen dalam bidang Tri Darma Perguruan Tinggi, yaitu Pendidikan, Penelitian, dan Pengabdian Masyarakat.','Lecturer Management Information System','assets/image/product/book1.png','https://www.laksitastartup.com/','2021-04-22 11:17:52','2021-04-22 11:17:52',NULL),
(16,'SIMPEG','Simstem Informasi Manajemen Kepegawaian merupakan aplikasi manajemen kepegawaian di Universitas mulai dari manajemen riwayat dan data master pegawai, manajemen absensi pegawai, hingga manajemen Sasaran Kinerja Pegawai(SKP)','Personnel Management Information System','assets/image/product/simpeg.png','https://www.laksitastartup.com/','2021-04-22 11:30:48','2021-04-22 11:30:48',NULL);

/*Table structure for table `tb_project` */

DROP TABLE IF EXISTS `tb_project`;

CREATE TABLE `tb_project` (
  `id_project` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `description_en` text DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `instansi` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_project`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_project` */

insert  into `tb_project`(`id_project`,`name`,`description`,`description_en`,`image`,`instansi`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Sidik2','ini deskripsi ini deskripsi ini deskripsi ini deskripsi ini deskripsi ini deskripsi ini deskripsi ini deskripsi ini deskripsi ini deskripsi','Edited Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.','assets/image/project/tele.png','MEDIKBUD','2021-02-27 08:12:32','2021-03-31 13:11:15','2021-03-31 13:11:15'),
(2,'SIKOP','ini deskirpsi ini deskirpsi  ini deskirpsi  ini deskirpsi  ini deskirpsi  ini deskirpsi  ini deskirpsi  ini deskirpsi  ini deskirpsi','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','assets/image/project/product.png',NULL,'2021-02-27 08:56:32','2021-02-27 08:57:09','2021-02-27 08:57:09'),
(3,'SIKOP','ini deeskirpsi','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','assets/image/project/product.png','KOMINFO BALI','2021-02-27 08:57:27','2021-03-31 13:11:18','2021-03-31 13:11:18'),
(4,'SISIK','ini deskripsi','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','assets/image/project/nayeon.jpg','KOMINFO BALI','2021-03-05 03:31:46','2021-03-31 13:11:25','2021-03-31 13:11:25'),
(5,'SISAKTI','ini deskripsi ini deskripsi ini deskripsi ini deskripsi ini deskripsi\r\nini deskripsi ini deskripsi ini deskripsi ini deskripsi ini deskripsi\r\nini deskripsi ini deskripsi ini deskripsi ini deskripsi ini deskripsi\r\nini deskripsi ini deskripsi ini deskripsi ini deskripsi ini deskripsi','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','assets/image/project/Screenshot (586).png','MEDIKBUD','2021-03-05 04:42:00','2021-03-31 13:11:21','2021-03-31 13:11:21'),
(6,'SIMPEDAS','Indo Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.','assets/image/project/Screenshot (284).png','Universitas Udayana','2021-03-26 13:52:22','2021-03-26 13:53:02','2021-03-26 13:53:02'),
(7,'SRUTI','Sistem informasi universitas terintegrasi Single Sign On (SSO)','Single Sign On (SSO) integrated university information system','assets/image/project/sruti.png','-','2021-03-31 16:22:55','2021-03-31 16:22:55',NULL);

/*Table structure for table `tb_project_trial` */

DROP TABLE IF EXISTS `tb_project_trial`;

CREATE TABLE `tb_project_trial` (
  `id_project_trial` int(11) NOT NULL AUTO_INCREMENT,
  `id_project` tinyint(4) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_project_trial`),
  KEY `id_project` (`id_project`),
  CONSTRAINT `tb_project_trial_ibfk_1` FOREIGN KEY (`id_project`) REFERENCES `tb_project` (`id_project`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_project_trial` */

insert  into `tb_project_trial`(`id_project_trial`,`id_project`,`url`,`created_at`,`updated_at`,`deleted_at`) values 
(3,7,'https://www.laksitastartup.com/','2021-03-31 16:23:17','2021-03-31 16:23:17',NULL);

/*Table structure for table `tb_social_media` */

DROP TABLE IF EXISTS `tb_social_media`;

CREATE TABLE `tb_social_media` (
  `id_social_media` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_social_media`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_social_media` */

insert  into `tb_social_media`(`id_social_media`,`name`,`image`,`url`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'facebook','assets/image/social-media/facebook.png','https://www.facebook.com/laksita.emisaguna.1','2021-03-18 18:24:26','2021-04-01 05:47:48',NULL),
(2,'instagram','assets/image/social-media/instagram.jpg','https://www.instagram.com/laksitaemi/','2021-04-01 05:54:19','2021-04-01 05:54:19',NULL);

/*Table structure for table `tb_submenu` */

DROP TABLE IF EXISTS `tb_submenu`;

CREATE TABLE `tb_submenu` (
  `id_submenu` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `id_page` int(11) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_submenu`),
  KEY `id_menu` (`id_menu`),
  KEY `id_page` (`id_page`),
  CONSTRAINT `tb_submenu_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `tb_menu` (`id_menu`),
  CONSTRAINT `tb_submenu_ibfk_2` FOREIGN KEY (`id_page`) REFERENCES `tb_page` (`id_page`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_submenu` */

insert  into `tb_submenu`(`id_submenu`,`name`,`id_menu`,`id_page`,`url`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Sub Menu 1',1,2,NULL,'2021-04-05 08:16:12','2021-04-05 09:46:29','2021-04-05 09:46:29'),
(2,'Sub Menu 2',6,2,NULL,'2021-04-05 08:20:39','2021-04-22 14:23:25','2021-04-22 14:23:25'),
(3,'submenu 3',8,NULL,'https://www.laksitastartup.com/','2021-04-10 11:02:30','2021-04-22 14:23:43','2021-04-22 14:23:43');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`type`,`image`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Bayu Suarnata Wahyu Putra','bayu@gmail.com',NULL,'$2y$10$fNS4BB/m/zQBGEeTtijYE.9FJVBafTcMuySoUOrq2kpx5mGg9doYq',NULL,1,'assets/image/user/1//WhatsApp Image 2020-07-10 at 9.35.12 AM.jpeg','2021-02-24 07:57:39','2021-04-05 15:49:06',NULL),
(2,'admin','admin2@gmail.com',NULL,'$2y$10$nXVmT.Crkwh.h5PlnuY8B.JicK706XCIE8HIR2hqL7Y18l/WZMaEi',NULL,0,NULL,'2021-04-05 14:22:00','2021-04-22 14:31:04',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
