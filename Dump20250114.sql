CREATE DATABASE  IF NOT EXISTS `koni_web` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `koni_web`;
-- MySQL dump 10.13  Distrib 8.0.36, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: koni_web
-- ------------------------------------------------------
-- Server version	9.0.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `atlit`
--

DROP TABLE IF EXISTS `atlit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `atlit` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_cabor` int NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kota_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `npwp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sertifikat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ktp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atlit`
--

LOCK TABLES `atlit` WRITE;
/*!40000 ALTER TABLE `atlit` DISABLE KEYS */;
/*!40000 ALTER TABLE `atlit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `barang`
--

DROP TABLE IF EXISTS `barang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `barang` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kode_belanja` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nama_barang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `harga_satuan` bigint DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kegiatan_id_IDX` (`id`,`kode_barang`,`nama_barang`) USING BTREE,
  KEY `barang_harga_satuan_IDX` (`harga_satuan`) USING BTREE,
  KEY `barang_kode_belanja_IDX` (`kode_belanja`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barang`
--

LOCK TABLES `barang` WRITE;
/*!40000 ALTER TABLE `barang` DISABLE KEYS */;
INSERT INTO `barang` VALUES (1,'1.1.5.1','1.1.5.0','Gula Pasir Premium',23500),(2,'1.1.5.2','1.1.5.0','Teh',11100),(3,'1.1.5.3','1.1.5.0','Kopi bubuk kemasan',64400),(4,'1.1.5.4','1.1.5.0','Air Mineral Galon',26000),(5,'1.1.5.5','1.1.5.0','Air Mineral 220Ml ',35700),(6,'1.1.5.6','1.1.5.0','Cairan pembersih lantai Lantai 750 Ml',17700),(7,'1.1.5.7','1.1.5.0','Cairan Pembersih kaca 440 Ml',8700),(8,'1.1.5.8','1.1.5.0','Cairan Pembersih Gelas 400 Ml',32400),(9,'1.1.5.9','1.1.5.0','Tisu gulung 2 ply isi 6',28200),(10,'1.1.5.10','1.1.5.0','Tissue 2 ply 250 Sheet',16200),(11,'1.1.5.11','1.1.5.0','Sabun Mandi Cair 100Ml',21700),(12,'1.1.5.12','1.1.5.0','Shampo 340 Ml',45800),(13,'1.1.5.13','1.1.5.0','Pengharum mobil glade 80 Ml',56300),(14,'1.1.5.14','1.1.5.0','Pengharum ruangan Spray, Refill 225ML',63500),(15,'1.1.5.15','1.1.5.0','Kapur barus kamar mandi isi 5',35400),(16,'1.1.5.16','1.1.5.0','Plastik sampah 90 x 120',60700),(17,'1.1.5.17','1.1.5.0','Gas LPG 3 kg',43500),(18,'1.1.6.1','1.1.6.0','Alat pel lantai super mop',143800),(19,'1.1.6.2','1.1.6.0','Alat pembersih kaca kecil',25000),(20,'1.1.6.3','1.1.6.0','Asbak Stenless',62500),(21,'1.1.6.4','1.1.6.0','Cangkir Kopi keramik premium',270700),(22,'1.1.6.5','1.1.6.0','Cikrak Plastik',34300),(23,'1.1.6.6','1.1.6.0','Gelas kaca',11200),(24,'1.1.6.7','1.1.6.0','Gayung Plastik',15500),(25,'1.1.6.8','1.1.6.0','Keset sepet sedang',96600),(26,'1.1.6.9','1.1.6.0','Kemuceng Microfiber',43700),(27,'1.1.6.10','1.1.6.0','Kanebo 43 x 32.5',64300),(28,'1.1.6.11','1.1.6.0','Piring biasa',52600),(29,'1.1.6.12','1.1.6.0','Mangkok melamin 4,5 in',85500),(30,'1.1.6.13','1.1.6.0','Sapu lantai 80 cm',39200),(31,'1.1.6.14','1.1.6.0','Sapu lidi gagang',41600),(32,'1.1.6.15','1.1.6.0','Sendok makan stenless 808',30900),(33,'1.1.6.16','1.1.6.0','Sendok the',13000),(34,'1.1.6.17','1.1.6.0','Sikat pembersih kamar mandi',73600),(35,'1.1.6.18','1.1.6.0','squerre pembersih kaca',43500),(36,'1.1.6.19','1.1.6.0','Tempat sampah besar 100L beroda',630100),(37,'1.1.6.20','1.1.6.0','Tempat sampah injak stenless',216700),(38,'1.2.1.1','1.2.1.0','Bantalan Stempel kecil',48000),(39,'1.2.1.2','1.2.1.0','Ballpoint BPT-P, Isi 12 Buah',28900),(40,'1.2.1.3','1.2.1.0','Ballpoint Ball Liner 0.8 mm',192600),(41,'1.2.1.4','1.2.1.0','Binder Clip No. 111, Isi 12 Buah',6000),(42,'1.2.1.5','1.2.1.0','Binder Clip No. 155, Isi 12 Buah',8400),(43,'1.2.1.6','1.2.1.0','Binder Clip No. 200, Isi 12 Buah',14400),(44,'1.2.1.7','1.2.1.0','Binder Clip No. 260, Isi 12 Buah',21500),(45,'1.2.1.8','1.2.1.0','Buku Kwitansi Isi 80 Lembar',11000),(46,'1.2.1.9','1.2.1.0','Correction Tape',21600),(47,'1.2.1.10','1.2.1.0','Cutter L-500',12900),(48,'1.2.1.11','1.2.1.0','Gunting Ukuran Sedang',20500),(49,'1.2.1.12','1.2.1.0','Isi Cutter L-150, 0.5 mm, Isi 12 Pcs',67300),(50,'1.2.1.13','1.2.1.0','Isi Staples No. 10-1M',4100),(51,'1.2.1.14','1.2.1.0','Isi Staples No. 3-1M',5600),(52,'1.2.1.15','1.2.1.0','Isi Staples No. 1213 F-AH, Heavy Duty 1/2\" Staples',26500),(53,'1.2.1.16','1.2.1.0','Isi Staples No. 1217 F-AH, Heavy Duty 9/16\" Staples',31200),(54,'1.2.1.17','1.2.1.0','Isolasi Lakban  Hitam, Uk 46 mm x 12 m',17500),(55,'1.2.1.18','1.2.1.0','Lem Kertas GS-09, 8 Gr',3500),(56,'1.2.1.19','1.2.1.0','Ordner Ukuran Folio, Tebal 7 Cm ',39000),(57,'1.2.1.20','1.2.1.0','Paper Clip No.3, Trigonal Clips',3800),(58,'1.2.1.21','1.2.1.0','Pencabut Staples No. 1164',13600),(59,'1.2.1.22','1.2.1.0','Penggaris Bahan Stainless Steel, Panjang 30 cm ',10900),(60,'1.2.1.23','1.2.1.0','Penggaris Bahan Stainless Steel, Panjang 50 cm ',27200),(61,'1.2.1.24','1.2.1.0','Penghapus Pensil sedang',3600),(62,'1.2.1.25','1.2.1.0','Penghapus White Board kecil',12800),(63,'1.2.1.26','1.2.1.0','Pensil 2B, 12 Buah',17900),(64,'1.2.1.27','1.2.1.0','Perforator/Punch No. 40XL (pelubang kertas)',42000),(65,'1.2.1.28','1.2.1.0','Post It Kertas, Uk. 38 x 51 Mm',3300),(66,'1.2.1.29','1.2.1.0','Post It Kertas, Uk. 76 x 76 Mm',8100),(67,'1.2.1.30','1.2.1.0','Spidol White Board Boardmarker, BG-12',9600),(68,'1.2.1.31','1.2.1.0','Spidol White Board Boardmarker, ABG-12',8600),(69,'1.2.1.32','1.2.1.0','Stabilo Warna',13300),(70,'1.2.1.33','1.2.1.0','Map Dinas Ukuran F4 ',4300),(71,'1.2.1.34','1.2.1.0','Tinta Stempel 50 Ml',28900),(72,'1.2.1.35','1.2.1.0','Amplop Putih, Ukuran 95 x 152 mm, Isi 100 Lembar, \n80 gsm, dengan Perekat',20500),(73,'1.2.1.36','1.2.1.0','Amplop Putih, Ukuran 110 x 230 mm, Isi 100 Lembar, \n80 gsm, dengan Perekat',27200),(74,'1.2.1.37','1.2.1.0','Amplop Dinas Coklat, Ukuran 10,8 Cm x 23,9 Cm',800),(75,'1.2.1.38','1.2.1.0','Kertas HVS Ukuran A4 70 Gram',61100),(76,'1.2.1.39','1.2.1.0','Kertas HVS Ukuran A4 80 Gram',66600),(77,'1.2.1.40','1.2.1.0','Kertas HVS Ukuran F4 70 Gram',66400),(78,'1.2.1.41','1.2.1.0','Kertas Karbon Ukuran Folio, Isi 100 Lembar',60600),(79,'1.2.1.42','1.2.1.0','Tinta Printer Epson 003 Ink Bottle, Black, 65 ML',95800),(80,'1.2.1.43','1.2.1.0','Tinta Printer Epson 003 Ink Bottle, warna, 65 ML',95800),(81,'1.2.1.44','1.2.1.0','Tinta Printer Epson 664 Ink Bottle, Black, 70 ML',97700),(82,'1.2.1.45','1.2.1.0','Tinta Printer Epson 664 Ink Bottle, warna, 70 ML',97700),(83,'1.2.2.1','1.2.2.0','Belanja Service laptop',NULL),(84,'1.2.3.1','1.2.3.0','Belanja Service Printer',NULL),(85,'1.2.4.1','1.2.4.0','Belanja Service AC',NULL),(86,'1.3.1.1','1.3.1.0','Belanja Internet',NULL),(87,'1.3.2.1','1.3.2.0','Belanja Listrik',NULL),(88,'1.3.3.1','1.3.3.0','Belanja Air',NULL),(89,'1.3.4.1','1.3.4.0','Belanja Sampah',NULL),(90,'1.4.1.1','1.4.1.0','Belanja Service dan ganti oli Kendaraan Dinas',NULL),(91,'1.4.2.1','1.4.2.0','Belanja Service dan ganti oli Elf',NULL),(92,'1.4.3.1','1.4.3.0','Belanja Service dan ganti oli Carry',NULL),(93,'1.4.4.1','1.4.4.0','Belanja Ganti Ban Kendaraan Dinas',NULL),(94,'1.4.5.1','1.4.5.0','Belanja Ganti Ban Elf',NULL),(95,'1.4.6.1','1.4.6.0','Belanja Ganti Ban Carry',NULL),(96,'1.5.1.1','1.5.1.0','Belanja Pajak Kendaraan Dinas',NULL),(97,'1.5.2.1','1.5.2.0','Belanja Pajak Elf',NULL),(98,'1.5.3.1','1.5.3.0','Belanja Pajak Carry',NULL),(99,'1.6.1.1','1.6.1.0','KETUA',1350000),(100,'1.6.1.2','1.6.1.0','WAKIL KETUA',1100000),(101,'1.6.1.3','1.6.1.0','SEKRETARIS',1100000),(102,'1.6.1.4','1.6.1.0','BENDAHARA',1100000),(103,'1.6.1.5','1.6.1.0','BADAN AUDITOR INTERNAL',500000),(104,'1.6.1.6','1.6.1.0','BIDANG PERENCANAAN ,PROGRAM DAN ANGGARAN',300000),(105,'1.6.1.7','1.6.1.0','BIDANG PEMBINAAN PRESTASI DAN SPORT SCIENCE',300000),(106,'1.6.1.8','1.6.1.0','BIDANG HUKUM DAN ORGANISASI',300000),(107,'1.6.1.9','1.6.1.0','BIDANG MEDIA DAN HUMAS',300000),(108,'1.6.1.10','1.6.1.0','BIDANG PENDIDIKAN DAN PEMANDU BAKAT',300000),(109,'1.6.1.11','1.6.1.0','BIDANG KERJASAMA DAN HUBUNGAN ANTAR LEMBAGA',300000),(110,'1.6.2.1','1.6.2.0','KETUA',1500000),(111,'1.6.2.2','1.6.2.0','WAKIL KETUA',1000000),(112,'1.6.2.3','1.6.2.0','SEKRETARIS',1000000),(113,'1.6.2.4','1.6.2.0','BENDAHARA',1000000),(114,'1.6.2.5','1.6.2.0','BADAN AUDITOR INTERNAL',500000);
/*!40000 ALTER TABLE `barang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `belanja`
--

DROP TABLE IF EXISTS `belanja`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `belanja` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_belanja` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kode_rekening` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `uraian_belanja` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kegiatan_id_IDX` (`id`,`kode_belanja`,`uraian_belanja`) USING BTREE,
  KEY `belanja_kode_rekening_IDX` (`kode_rekening`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `belanja`
--

LOCK TABLES `belanja` WRITE;
/*!40000 ALTER TABLE `belanja` DISABLE KEYS */;
INSERT INTO `belanja` VALUES (1,'1.1.1.0','1.1.0.0','Belanja Seragam KONI'),(2,'1.1.2.0','1.1.0.0','Belanja Seragam Staf KONI'),(3,'1.1.3.0','1.1.0.0','Belanja Bendera KONI'),(4,'1.1.4.0','1.1.0.0','Belanja Kalender KONI'),(5,'1.1.5.0','1.1.0.0','Belanja bahan kebutuhan Kantor'),(6,'1.1.6.0','1.1.0.0','Belanja alat Kebutuhan Kantor'),(7,'1.2.1.0','1.2.0.0','Belanja ATK'),(8,'1.2.2.0','1.2.0.0','Belanja Service laptop'),(9,'1.2.3.0','1.2.0.0','Belanja Service Printer'),(10,'1.2.4.0','1.2.0.0','Belanja Service AC'),(11,'1.3.1.0','1.3.0.0','Belanja Internet'),(12,'1.3.2.0','1.3.0.0','Belanja Listrik'),(13,'1.3.3.0','1.3.0.0','Belanja Air'),(14,'1.3.4.0','1.3.0.0','Belanja Sampah'),(15,'1.4.1.0','1.4.0.0','Belanja Service dan ganti oli Kendaraan Dinas'),(16,'1.4.2.0','1.4.0.0','Belanja Service dan ganti oli Elf'),(17,'1.4.3.0','1.4.0.0','Belanja Service dan ganti oli Carry'),(18,'1.4.4.0','1.4.0.0','Belanja Ganti Ban Kendaraan Dinas'),(19,'1.4.5.0','1.4.0.0','Belanja Ganti Ban Elf'),(20,'1.4.6.0','1.4.0.0','Belanja Ganti Ban Carry'),(21,'1.5.1.0','1.5.0.0','Belanja Pajak Kendaraan Dinas'),(22,'1.5.2.0','1.5.0.0','Belanja Pajak Elf'),(23,'1.5.3.0','1.5.0.0','Belanja Pajak Carry'),(24,'1.6.1.0','1.6.0.0','Tunjangan Kinerja Pengurus'),(25,'1.6.2.0','1.6.0.0','Tunjangan hari Raya Pengurus'),(26,'1.6.3.0','1.6.0.0','BIMTEK Sinkronisasi Tata kelola keuangan Cabor dan KONI'),(27,'1.6.4.0','1.6.0.0','Peningkatan SDM Cabor, Pengurus dan staf KONI'),(28,'2.1.1.0','2.1.0.0','Rapat Kerja KONI'),(29,'2.1.2.0','2.1.0.0','Rapat Pengurus inti '),(30,'2.1.3.0','2.1.0.0','Rapat Pengurus ( Semester )'),(31,'2.1.4.0','2.1.0.0','Rapat Pengurus Utama'),(32,'2.1.5.0','2.1.0.0','Rapat Persiapan PORPROV'),(33,'2.2.1.0','2.2.0.0','Perjalanan Dinas dalam Daerah '),(34,'2.3.1.0','2.3.0.0','Perjalanan Dinas luar Daerah'),(35,'3.1.1.0','3.1.0.0','Honor Staff Kesekretariatan'),(36,'3.1.2.0','3.1.0.0','Honor Tenaga Kebersihan'),(37,'3.1.3.0','3.1.0.0','Honor Staff Keamanan'),(38,'3.1.4.0','3.1.0.0','Tunjangan Hari Raya Staff'),(39,'4.1.1.0','4.1.0.0','meubeler'),(40,'4.1.2.0','4.1.0.0','Alat Elektronik kantor'),(41,'4.1.3.0','4.1.0.0','Belanja Alat POSSI'),(42,'4.1.4.0','4.1.0.0','Belanja Alat ISSI'),(44,'5.1.1.0','5.1.0.0','Beasiswa Atlet Berprestasi'),(45,'5.1.2.0','5.1.0.0','Support Pengiriman Atlet Berprestasi'),(46,'6.1.1.0','6.1.0.0','Monitoring Semester 1'),(48,'6.1.2.0','6.1.0.0','Monitoring Semester 2'),(49,'6.2.1.0','6.2.0.0','Evaluasi Tahap 1 (Vo2Mak)'),(51,'6.2.1.0','6.2.0.0','Evaluasi Tahap 2 (Vo2Mak)'),(52,'6.3.1.0','6.3.0.0','Hipnoterapy '),(53,'6.3.1.0','6.3.0.0','Pelepasan atlet PORPROV');
/*!40000 ALTER TABLE `belanja` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cabor`
--

DROP TABLE IF EXISTS `cabor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cabor` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_cabor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cabor`
--

LOCK TABLES `cabor` WRITE;
/*!40000 ALTER TABLE `cabor` DISABLE KEYS */;
INSERT INTO `cabor` VALUES (1,'PELTI'),(2,'IKASI'),(3,'IPSI'),(4,'PERCASI'),(5,'FORKI'),(6,'PSSI'),(7,'PRSI'),(8,'PERSANI'),(9,'PERBASI'),(10,'TAEKWONDO'),(11,'WUSHU'),(12,'PSTI'),(13,'PBVSI'),(14,'PDBI'),(15,'PASI'),(16,'PBSI'),(17,'PTMSI'),(18,'ISSI'),(19,'PERTINA'),(20,'HOCKEY'),(21,'PERPANI'),(22,'MUAYTHAI'),(23,'KODRAT'),(24,'FPTI'),(25,'POSSI'),(26,'KICK BOXING'),(27,'FOPI'),(28,'ABTI'),(29,'PARALAYANG'),(30,'FAJI'),(31,'PBFI'),(32,'PORDASI'),(33,'ESI'),(34,'WoodBall'),(35,'IBCA MMA');
/*!40000 ALTER TABLE `cabor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `informasi`
--

DROP TABLE IF EXISTS `informasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `informasi` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug_judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('draft','publish') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `informasi_slug_judul_unique` (`slug_judul`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `informasi`
--

LOCK TABLES `informasi` WRITE;
/*!40000 ALTER TABLE `informasi` DISABLE KEYS */;
INSERT INTO `informasi` VALUES (1,'Monitoring Pelaksanaan Pembangunan Sarana','monitoring-pelaksanaan-pembangunan-sarana','Berita','<p>test</p>','tuxy','draft','informasi/Berita/gambar_Berita_monitoring-pelaksanaan-pembangunan-sarana_20250114080333.png',NULL,'2025-01-14','2025-01-14 20:03:33','2025-01-14 20:03:33');
/*!40000 ALTER TABLE `informasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kegiatan`
--

DROP TABLE IF EXISTS `kegiatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kegiatan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_kegiatan` varchar(100) NOT NULL,
  `uraian_kegiatan` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kegiatan_id_IDX` (`id`,`kode_kegiatan`,`uraian_kegiatan`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kegiatan`
--

LOCK TABLES `kegiatan` WRITE;
/*!40000 ALTER TABLE `kegiatan` DISABLE KEYS */;
INSERT INTO `kegiatan` VALUES (1,'1.0.0.0','Kesekretariatan'),(2,'2.0.0.0','Belanja Kegiatan Rapat Kerja KONI'),(3,'3.0.0.0','Honorarium Staff'),(4,'4.0.0.0','Belanja Inventaris KONI'),(5,'5.0.0.0','Pembinaan dan Support Atlet Berprestasi'),(6,'6.0.0.0','Pra PORPROV');
/*!40000 ALTER TABLE `kegiatan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `limit_nominal`
--

DROP TABLE IF EXISTS `limit_nominal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `limit_nominal` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` int NOT NULL,
  `nominal` bigint NOT NULL,
  `nominal_sisa` bigint DEFAULT NULL,
  `nominal_terpakai` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `limit_nominal`
--

LOCK TABLES `limit_nominal` WRITE;
/*!40000 ALTER TABLE `limit_nominal` DISABLE KEYS */;
INSERT INTO `limit_nominal` VALUES (1,'tux',2025,1000000,1000000,0,'2024-12-31 07:14:09','2024-12-31 07:14:09');
/*!40000 ALTER TABLE `limit_nominal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(6,'2024_05_17_015754_create_informasi_table',2),(8,'2024_12_30_231553_create_limit_nominal_table',4),(11,'2024_12_31_035352_create_cabor_table',6),(12,'2014_10_12_000000_create_users_table',7),(14,'2024_12_31_063048_create_pengurus_cabor_table',8),(15,'2024_12_31_163215_create_pelatih_table',9),(16,'2025_01_01_050959_create_atlit_table',10),(17,'2025_01_01_061226_create_prestasi_table',11);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pelatih`
--

DROP TABLE IF EXISTS `pelatih`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pelatih` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_cabor` int NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kota_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `npwp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sertifikat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ktp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pelatih`
--

LOCK TABLES `pelatih` WRITE;
/*!40000 ALTER TABLE `pelatih` DISABLE KEYS */;
/*!40000 ALTER TABLE `pelatih` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengurus_cabor`
--

DROP TABLE IF EXISTS `pengurus_cabor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pengurus_cabor` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_cabor` int NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kota_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `npwp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('KETUA','WAKIL KETUA','SEKRETARIS','BENDAHARA','ANGGOTA') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ANGGOTA',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengurus_cabor`
--

LOCK TABLES `pengurus_cabor` WRITE;
/*!40000 ALTER TABLE `pengurus_cabor` DISABLE KEYS */;
INSERT INTO `pengurus_cabor` VALUES (2,16,'3574042710940001','asdasd','L','asdasdad','2024-12-30','23123123','pengurus_cabor/PBSI/foto16_PBSI_20241231033459.jpg','WAKIL KETUA','2024-12-31 15:34:59','2024-12-31 17:05:05'),(3,16,'123123123123','asdasdasd','L','asdasdasd','2024-12-31','3144123123','pengurus_cabor/PBSI/foto16_PBSI_20241231033617.png','KETUA','2024-12-31 15:36:17','2024-12-31 15:36:17');
/*!40000 ALTER TABLE `pengurus_cabor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perencanaan`
--

DROP TABLE IF EXISTS `perencanaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perencanaan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_kegiatan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kode_rekening` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `kode_belanja` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kode_barang` varchar(100) DEFAULT NULL,
  `harga_satuan` bigint DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `satuan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `bulan` varchar(100) DEFAULT NULL,
  `tahun_anggaran` year DEFAULT NULL,
  `cabor` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `barang_harga_satuan_IDX` (`kode_barang`) USING BTREE,
  KEY `barang_kode_belanja_IDX` (`kode_rekening`) USING BTREE,
  KEY `kegiatan_id_IDX` (`id`,`kode_kegiatan`,`kode_belanja`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perencanaan`
--

LOCK TABLES `perencanaan` WRITE;
/*!40000 ALTER TABLE `perencanaan` DISABLE KEYS */;
INSERT INTO `perencanaan` VALUES (3,'1.0.0.0','1.1.0.0','1.1.5.0','1.1.5.1',23500,1,'bag','1',2025,'16','2','2025-01-13 11:08:12','test1','2025-01-14 15:41:26',NULL),(4,'1.0.0.0','1.1.0.0','1.1.5.0','1.1.5.12',45800,1,'Botol','1',2025,'16','0','2025-01-14 19:58:29','test1','2025-01-14 19:58:29',NULL);
/*!40000 ALTER TABLE `perencanaan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prestasi`
--

DROP TABLE IF EXISTS `prestasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prestasi` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_cabor` int NOT NULL,
  `nama_kejuaraan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tingkat_kejuaraan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu_kegiatan` datetime NOT NULL,
  `perolehan_medali` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scan_piagam` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scan_hasil_pertandingan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prestasi`
--

LOCK TABLES `prestasi` WRITE;
/*!40000 ALTER TABLE `prestasi` DISABLE KEYS */;
/*!40000 ALTER TABLE `prestasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rekening`
--

DROP TABLE IF EXISTS `rekening`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rekening` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_rekening` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kode_kegiatan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `uraian_rekening` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kegiatan_id_IDX` (`id`,`kode_rekening`,`uraian_rekening`) USING BTREE,
  KEY `rekening_kode_kegiatan_IDX` (`kode_kegiatan`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rekening`
--

LOCK TABLES `rekening` WRITE;
/*!40000 ALTER TABLE `rekening` DISABLE KEYS */;
INSERT INTO `rekening` VALUES (1,'1.1.0.0','1.0.0.0','Belanja rumah tangga KONI'),(2,'1.2.0.0','1.0.0.0','Belanja ATK dan Perawatan Alat kantor'),(3,'1.3.0.0','1.0.0.0','Belanja Bulanan'),(4,'1.4.0.0','1.0.0.0','Belanja Perawatan Kendaraan Operasional kantor'),(5,'1.5.0.0','1.0.0.0','Belanja Bea Pajak Dan Nomor Kendaraan Operasional kantor'),(6,'1.6.0.0','1.0.0.0','Belanja Kegiatan Peningkatan kapasitas Pengurus dan cabor'),(7,'2.1.0.0','2.0.0.0','Belanja Kegiatan Rapat Kerja KONI'),(8,'2.2.0.0','2.0.0.0','Belanja perjalanan Dinas Dalam Daerah'),(9,'2.3.0.0','2.0.0.0','Belanja perjalanan Dinas Luar Daerah'),(10,'3.1.0.0','3.0.0.0','Honorarium Staff'),(11,'4.1.0.0','4.0.0.0','Belanja Inventaris KONI'),(12,'5.1.0.0','5.0.0.0','Pembinaan dan Support Atlet Berprestasi'),(13,'6.1.0.0','6.0.0.0','Monitoring Kegiatan Cabor'),(14,'6.2.0.0','6.0.0.0','Evaluasi Kegiatan Cabor'),(15,'6.3.0.0','6.0.0.0','Pemantaban Atlet dan Pelatih'),(16,'6.3.0.0','6.0.0.0','Pelepasan Atlet PORPROV');
/*!40000 ALTER TABLE `rekening` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cabor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','staff','cabor') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'staff',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('36fbc60d-7634-495d-8677-dbf4729ca1fd','test2','test2','test@test2','$2y$10$HKrO9j/3kIvttPvDf1hiWuRtcrrA2oh6P6PWeGDOoTY/VfWEZkAg.','WUSHU','cabor',NULL,'2024-12-31 15:46:43','2024-12-31 15:46:43'),('58967c7b-9735-11ef-ae56-0242ac180004','tux','tuxy','tux@tux','$2y$10$vKvGNTT/2JXOZRzz5jRXueag8fnZyt7o/9iyx6IqAHleV5G38f.9y',NULL,'admin',NULL,NULL,'2024-12-31 16:41:05'),('7252243c-b623-4b14-93d2-1a98c315555a','test1','test1','test@test','$2y$10$90c/7zI9QJRS3kG1dgWSFejJayMwt2caxXiwKUYedGW6EiVI0rtjK','PBSI','cabor',NULL,'2024-12-31 11:27:21','2024-12-31 11:36:33');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-14 20:41:54
