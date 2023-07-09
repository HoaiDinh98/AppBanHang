-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 31, 2023 lúc 12:04 PM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `android_2`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdonhang`
--

CREATE TABLE `chitietdonhang` (
  `iddon` int(11) NOT NULL,
  `idsp` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `gia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `id` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `sdt` varchar(20) NOT NULL,
  `diachi` varchar(255) NOT NULL,
  `soluong` int(11) NOT NULL,
  `tongtien` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`id`, `iduser`, `sdt`, `diachi`, `soluong`, `tongtien`) VALUES
(1, 1, 'ss', 'ss', 1, '1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaisp`
--

CREATE TABLE `loaisp` (
  `MaLoaiSP` int(10) UNSIGNED NOT NULL,
  `TenLoaiSP` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `loaisp`
--

INSERT INTO `loaisp` (`MaLoaiSP`, `TenLoaiSP`) VALUES
(1, 'Quần Dài'),
(2, 'Quần Sort'),
(3, 'Áo sơ mi'),
(4, 'Áo thun');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mau`
--

CREATE TABLE `mau` (
  `MaMau` int(10) UNSIGNED NOT NULL,
  `TenMau` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `mau`
--

INSERT INTO `mau` (`MaMau`, `TenMau`) VALUES
(1, 'Đen'),
(2, 'Trắng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `MaSp` int(10) UNSIGNED NOT NULL,
  `TenSP` varchar(100) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `HinhAnh` varchar(250) NOT NULL,
  `ChiTiet` text NOT NULL,
  `DonGia` int(100) NOT NULL,
  `MaMau` int(10) UNSIGNED NOT NULL,
  `MaLoai` int(10) UNSIGNED NOT NULL,
  `MaSize` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`MaSp`, `TenSP`, `SoLuong`, `HinhAnh`, `ChiTiet`, `DonGia`, `MaMau`, `MaLoai`, `MaSize`) VALUES
(1120, 'Áo sơ mi tay dài sợi Modal Tối Giản', 0, 'https://cdn2.yame.vn/pimg/so-mi-nam-no-style-td-km18-0018246/8c0fe088-005b-0200-3f26-001a20115d2c.jpg?w=540&h=756&c=true&ntf=false', 'Được làm từ 12% modal và 88% superfine, ít nhăn và dễ ủi, nhanh khô và thoáng mát', 255000, 2, 3, 1),
(1121, 'Áo sơ mi tay dài sợi Cotton TSONS 31', 0, 'https://cdn2.yame.vn/pimg/so-mi-tay-dai-on-gian-y-nguyen-ban-ver46-0021352/9164c555-da49-7600-5b3d-001a298718d1.jpg?w=540&h=756&c=true&ntf=false', '72% Cotton 28% Polyester\r\nThoáng mát\r\nThấm hút mồ hôi\r\nHút ẩm tốt\r\nHạ nhiệt và làm mát cơ thể\r\nĐộ bền tương đối cao\r\nMềm mịn\r\n+ Vạt áo dạng vạt bầu\r\n+ Túi áo trước ngực tiện lợi hình thêu tinh tế\r\n+ Lá cổ cài khuy giúp định hình cổ áo', 257000, 2, 3, 1),
(1122, 'Áo Sơ Mi Tay Dài Sợi Poly', 0, 'https://cdn2.yame.vn/pimg/so-mi-tay-dai-on-gian-y-nguyen-ban-ver26-0020866/28ddd072-cc46-1100-0b47-001a1db57b85.jpg?w=540&h=756&c=true&ntf=false', 'Sơ Mi Tay Dài Đơn Giản Y Nguyên Bản Ver26\r\nHọa tiết may logo kim loại\r\nForm dáng rộng rãi thoải mái và thời trang', 297000, 2, 3, 1),
(1123, 'Áo Sơ Mi Tay Ngắn Cuban Valknut', 0, 'https://cdn2.yame.vn/pimg/so-mi-co-danton-than-co-ai-valknut-ver3-0021525/893222ae-ddc3-cf00-bc57-0019aa36f94a.jpg?w=540&h=756', 'Được làm từ 100% Polyester\r\nCo giãn tốt\r\nVải nhẹ\r\nMềm mịn\r\nThấm hút\r\nNhanh khô\r\nHọa tiết in chuyển nhiệt\r\n', 257000, 2, 3, 1),
(1124, 'Áo Sơ Mi Tay Ngắn Sợ Cotton', 0, 'https://cdn2.yame.vn/pimg/so-mi-tay-ngan-on-gian-y-nguyen-ban-ver16-0021045/c8a4a788-2125-7000-2113-001a2d78c0e0.jpg?w=540&h=756&c=true&ntf=false', 'Được làm từ 65% Cotton 35% Polyester, kiếu basic đơn giản', 197000, 2, 3, 1),
(1125, 'Áo Sơ Mi Tay Ngắn Sợi Poly TSONS 79', 0, 'https://cdn2.yame.vn/pimg/so-mi-tay-ngan-on-gian-y-nguyen-ban-ver50-0021393/95869bbd-58cd-0e01-517c-001a33e8b44f.jpg?w=540&h=756&c=true&ntf=false', 'Được làm từ 97% Polyester 3% Spandex\r\nSợi bải bền chắc\r\nÍt nhăn\r\nCo giãn tốt\r\nKiểu dáng đơn giản\r\nTúi áo phong cách trẻ trung, tiện lợi\r\n', 307000, 2, 3, 1),
(1126, 'Áo Sơ Mi Tay Dài Sợi Cotton Đơn Giản', 0, 'https://cdn2.yame.vn/pimg/so-mi-tay-dai-on-gian-y-nguyen-ban-ver47-0021402/5ebe0a3c-34c8-4c00-4603-0019e6b2e065.jpg?w=540&h=756', 'Được làm từ 55% Polyester 45% Cotton\r\nĐộ bền cao\r\nThấm hút tốt\r\nLàm mát cơ thể\r\nMay logo #Y2010', 327000, 2, 3, 1),
(1127, 'Áo Sợ Mi Tay Ngắn Cuban Sợi Cotton', 0, 'https://cdn2.yame.vn/pimg/ao-so-mi-cuban-soi-cotton-on-gian-y-nguyen-ban-ver57-0021860/807c7cae-72ee-0200-ceb1-001a2981baaa.jpg?w=540&h=756&c=true&ntf=false', 'Được làm từ 100% Cotton\r\n+ Cổ áo Cuban thời trang\r\n+ Họa tiết in họa tiết cactus', 167000, 2, 3, 1),
(1128, 'Áo Sơ Mi Tay Dài Sợi Modal TSONS 07', 0, 'https://cdn2.yame.vn/pimg/ao-so-mi-tay-dai-soi-modal-toi-gian-m25-0021950/26f15c31-49cd-cb00-360d-001a2d7bf9b8.jpg?w=540&h=756', 'Được làm từ 12% Modal 88% Polyester\r\nCo dãn tốt\r\nChống co rút tốt\r\nGiữ form sau nhiều lần sử dụng\r\nThấm hút\r\nThoát mồ hôi tốt\r\nVạt áo dạng bầu vạt', 197000, 2, 3, 1),
(1129, 'Áo Thun Cổ Trụ Ver10', 0, 'https://cdn2.yame.vn/pimg/ao-thun-co-tru-universal-4-element-ver10-0020329/d6fc0e10-3229-3400-4051-00189c1d5557.jpg?w=540&h=756', 'Được làm từ 100% Cotton\r\nThấm hút thoát ẩm\r\nMềm mại\r\nKiểm soát mùi\r\niều hòa nhiệt\r\nHọa tiết in dẻo + thêu', 255000, 2, 4, 1),
(1130, 'Áo Thun Cổ Trụ Y Ver94', 0, 'https://cdn2.yame.vn/pimg/ao-thun-co-tru-y-nguyen-ban-18--ver94-0021423/d8fcd2f4-eb07-1600-dcdc-001a1602636c.jpg?w=540&h=756', 'Được làm từ 100% Cotton\r\nThấm hút thoát ẩm\r\nMềm mại\r\nKiểm soát mùi\r\nĐiều hòa nhiệt\r\nHọa tiết in dẻo', 257000, 2, 4, 1),
(1131, 'Áo Thun Cổ Trụ Tối Giản M4', 0, 'https://cdn2.yame.vn/pimg/ao-thun-co-tru-toi-gian-m4-0020888/d49c6c50-e52e-1500-dfe2-001a19f963ea.jpg?w=540&h=756', 'Được làm từ 61% Polyester 33% Cotton 6% Spandex\r\nMay đắp logo inox', 257000, 2, 4, 1),
(1132, 'Áo Thun Cổ Trụ Khepri Ver3', 0, 'https://cdn2.yame.vn/pimg/ao-thun-co-tru-on-gian-than-co-ai-khepri-ver3-0020848/759108e7-83ee-1000-6229-001a1db55e95.jpg?w=540&h=756', 'Được làm từ 100% Cotton\r\nThân thiện\r\nThấm hút thoát ẩm\r\nMềm mại\r\nKiểm soát mùi\r\nĐiều hòa nhiệt\r\nHọa tiết in dẻo + thêu đắp giống', 287000, 2, 4, 1),
(1133, 'Áo Thun Cổ Trụ Y Ver61', 0, 'https://cdn2.yame.vn/pimg/ao-thun-co-tru-y-nguyen-ban-18-ver61-0021087/4de2014f-f603-0300-ddbc-0019710a8c1f.jpg?w=540&h=756', 'Được làm từ 100% Cotton\r\nThân thiện\r\nThấm hút thoát ẩm\r\nMềm mại\r\nKiểm soát mùi\r\nĐiều hòa nhiệt\r\nHọa tiết in dẻo', 287000, 2, 4, 1),
(1134, 'Áo Thun Cổ Tròn Valknut Ver5', 0, 'https://cdn2.yame.vn/pimg/ao-thun-co-tron-than-co-ai-valknut-ver5-0021754/6e6122f7-cf51-8e00-9903-0019b537d1c4.jpg?w=540&h=756', 'Được làm từ 92% cotton 8% spandex\r\nThân thiện\r\nThấm hút thoát ẩm\r\nMềm mại\r\nKiểm soát mùi\r\nĐiều hòa nhiệt\r\nHọa tiết in dẻo', 287000, 2, 4, 1),
(1135, 'Áo Thun Cổ Tròn Ver136', 0, 'https://cdn2.yame.vn/pimg/ao-thun-co-tron-on-gian-than-co-ai-poseidon-ver7-0021871/182d4aa2-6e4c-2100-5874-001a160369a8.jpg?w=540&h=756', 'Được làm từ 100% Cotton\r\nThân thiện\r\nThấm hút thoát ẩm\r\nMềm mại\r\nKiểm soát mùi\r\nĐiều hòa nhiệt\r\nHọa tiết in nước tràn thân + in PET cao thành', 197000, 2, 4, 1),
(1136, 'Áo Thun Cổ Trụ Space Ver27', 0, 'https://cdn2.yame.vn/pimg/ao-thun-co-tru-ngan-ha-space-ver27-0021285/26aaa274-54f0-c500-671a-00196833e61d.jpg?w=540&h=756', 'Được làm từ 100% Cotton\r\nThân thiện\r\nThấm hút thoát ẩm\r\nMềm mại\r\nKiểm soát mùi\r\nĐiều hòa nhiệt\r\nHọa tiết in dẻo\r\n\r\n', 287000, 2, 4, 1),
(1137, 'Áo Thun Cổ Tròn Bbuff Ver13', 0, 'https://cdn2.yame.vn/pimg/ao-thun-co-tron-linh-vat-bbuff-ver13-0020749/5eeb0240-e80e-2500-4c2f-00190f8b2951.jpg?w=540&h=756', 'Được làm từ 100% Cotton\r\nThân thiện\r\nThấm hút thoát ẩm\r\nMềm mại\r\nKiểm soát mùi\r\nĐiều hòa nhiệt\r\nHọa tiết in dẻo + thêu xù', 285000, 2, 4, 1),
(1138, 'Áo Thun Cổ Tròn Y Ver93', 0, 'https://cdn2.yame.vn/pimg/ao-thun-co-tron-y-nguyen-ban-18-ver93-0021412/5f31f1c8-9bee-5201-b344-0019a4c1465e.jpg?w=540&h=756', 'Được làm từ 100% Cotton\r\nThân thiện\r\nThấm hút thoát ẩm\r\nMềm mại\r\nKiểm soát mùi\r\nĐiều hòa nhiệt\r\nHọa tiết in dẻo + thêu motif run', 227000, 2, 4, 1),
(1139, 'Áo Thun Cổ Tròn Nguyên Bản Ver73', 0, 'https://cdn2.yame.vn/pimg/ao-thun-co-tron-on-gian-y-nguyen-ban-ver73-0021134/9ab873cb-f4ec-a400-3e5b-001983b8980b.jpg?w=540&h=756', 'Được làm từ 100% Cotton\r\nThân thiện\r\nThấm hút thoát ẩm\r\nMềm mại\r\nKiểm soát mùi\r\nĐiều hòa nhiệt\r\nHọa tiết in dẻo', 227000, 2, 4, 1),
(1140, 'Quần Dài Vải Nguyên Bản Ver3', 0, 'https://cdn2.yame.vn/pimg/quan-dai-sweatpants-on-gian-y-original-ver1-0020311/7258a8c4-d9fa-0f00-7288-001880661566.jpg?w=540&h=756', 'Được làm từ 100% poly\r\nCo giãn\r\nVải nhẹ\r\nMềm mịn\r\nĐộ bền\r\nDễ dàng giặt ủi\r\nHọa tiết in dẻo\r\nHai túi trước có dây kéo\r\nDây Rút Giấu Cạp Trong\r\nQuần bo vào mắt cá chân, cực kì hiệu quả trong việc che khuyết điểm', 285000, 2, 1, 1),
(1141, 'Quần Dài Vải Space Ver1', 0, 'https://cdn2.yame.vn/pimg/quan-dai-loose-pants-ngan-ha-space-ver1-0020629/eccdfd1d-0de0-6600-aa90-0018cd6ce23d.jpg?w=540&h=756\'', 'Được làm từ 100% Cotton\r\nThấm hút thoát ẩm\r\nMềm mại, ít nhăn\r\nCo giãn tối ưu\r\nThân thiện môi trường\r\nHọa tiết thêu + thêu xù\r\nDây Rút Giấu Cạp Trong\r\nHai túi bên hông Reverse Coil Zipper', 399000, 2, 1, 1),
(1142, 'Quần Tây Tối Giản HG17', 0, 'https://cdn2.yame.vn/pimg/quan-tay-y2010-hg17-0019806/de8efe08-0484-3400-c557-0018b9fba9ad.jpg?w=540&h=756', 'Được làm từ 82% polyester 14% rayon 4% spandex\r\nMềm mại\r\nThoáng khí\r\nThân thiện với mối trường\r\nHút ẩm tốt', 325000, 2, 1, 1),
(1143, 'Quần Tây TSONS 08', 0, 'https://cdn2.yame.vn/pimg/quan-tay-toi-gian-m11-0021955/934611ae-25f0-d700-c663-001a298a69d5.jpg?w=540&h=756', 'Được làm từ 82% Polyester 14% Rayon 4% Spandex\r\nCo dãn tốt\r\nKháng khuẩn\r\nMềm mịn\r\nÍt nhăn\r\nĐộ bền màu tương đối tốt', 277000, 2, 1, 1),
(1144, 'Quần Tây Tối Giản B2HG05', 0, 'https://cdn2.yame.vn/pimg/quan-tay-nam-no-style-dai-hg05-0018908/b8b43eb5-5037-3c00-f4f9-001637e5496b.jpg?w=540&h=756', 'Được làm từ 82% Polyester 14% Rayon 4% Spandex\r\nCo dãn tốt\r\nKháng khuẩn\r\nMềm mịn\r\nÍt nhăn\r\nĐộ bền màu tương đối tốt', 425000, 2, 1, 1),
(1145, 'Quần Tây Nguyên Bản Ver22', 0, 'https://cdn2.yame.vn/pimg/quan-tay-on-gian-y-nguyen-ban-ver22-0021425/3e132da5-4796-2c00-15e8-00198eb124d9.jpg?w=540&h=756', 'Được làm từ 70% Polyester 28% Rayon 2% Spandex\r\nThêu logo #Y2010', 427000, 2, 1, 1),
(1146, 'Quần Short Đơn Giản Ver13', 0, 'https://cdn2.yame.vn/pimg/quan-short-on-gian-y-nguyen-ban-ver13-0021315/aa2919e7-aa55-0300-8d42-001a15fe28ff.jpg?w=540&h=756', 'Được làm từ 100% cotton\r\nThấm hút thoát ẩm\r\nMềm mại\r\nCo giãn đàn hồi\r\nThân thiện môi trường\r\nHọa tiết thêu', 287000, 2, 2, 1),
(1147, 'Quần Short Anubis Ver2', 0, 'https://cdn2.yame.vn/pimg/quan-short-than-co-ai-anubis-ver2-0020425/f7ede122-2c0c-1800-6f7e-0018ce262ee4.jpg?w=540&h=756', 'Được làm từ 100% poly\r\nCo giãn\r\nVải nhẹ\r\nMềm mịn\r\nĐộ bền\r\nDễ dàng giặt ủi\r\nHọa tiết nhãn ép phản quang + thêu\r\n', 255000, 2, 2, 1),
(1148, 'Quần Short Bbuff Ver5', 0, 'https://cdn2.yame.vn/pimg/quan-short-linh-vat-bbuff-ver5-0020494/e8f32031-2d40-4300-2b67-0018a702e227.jpg?w=540&h=756', 'Được làm từ 100% Polyester\r\nHọa tiết in chuyển nhiệt\r\nSử dụng công nghệ in chuyển nhiệt trên vải tạo nên những họa tiết sắc nét sinh động.\r\nHình in không gây cộm\r\nSản phẩm in cho hình ảnh chân thực, bền hơn, ít phai màu hơn', 225000, 2, 2, 1),
(1149, 'Quần Short Space Ver6', 0, 'https://cdn2.yame.vn/pimg/quan-short-on-gian-ngan-ha-space-ver6-0021331/203a42a0-d538-5f00-a0f9-001a1dea93dd.jpg?w=540&h=756', 'Được làm từ 87% Cotton 13% Polyester\r\nCo giãn\r\nĐộ bền cao\r\nThoáng Khí\r\nNhanh khô\r\nHọa tiết thêu', 287000, 2, 2, 1),
(1150, 'Quần Short Đơn Giản Ver24', 0, 'https://cdn2.yame.vn/pimg/quan-short-on-gian-y-nguyen-ban-ver24-0021011/43907c8c-04ec-3201-cc22-00194cb4d399.jpg?w=540&h=756', 'Được làm từ 97% Cotton 3% Spandex\r\nHọa tiết Thêu đắp giống', 379000, 2, 2, 1),
(1151, 'Quần Short Space Ver5', 0, 'https://cdn2.yame.vn/pimg/quan-short-ngan-ha-space-ver5-0021037/005ac6e6-dd0f-2c01-70d8-0019733bb663.jpg?w=540&h=756', 'Được làm từ 100% Polyeste\r\nHọa tiết in chuyển nhiệt\r\nDây rút giấu cạp trong\r\nHai túi bên hông Reverse Coil Zipper', 257000, 2, 2, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `size`
--

CREATE TABLE `size` (
  `MaSize` int(10) UNSIGNED NOT NULL,
  `TenSize` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `size`
--

INSERT INTO `size` (`MaSize`, `TenSize`) VALUES
(1, 'Size S'),
(2, 'Size M'),
(3, 'Size L'),
(4, 'Size XL');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `id` int(11) NOT NULL,
  `TenTK` varchar(50) NOT NULL,
  `MK` varchar(50) NOT NULL,
  `TenKH` varchar(50) NOT NULL,
  `SDT` varchar(15) NOT NULL,
  `DiaChi` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`id`, `TenTK`, `MK`, `TenKH`, `SDT`, `DiaChi`, `Email`) VALUES
(1, 'tantruong', '123', 'Lê Bùi Tấn Trưởng', '0328467924', 'Lưu Chí Hiếu - Tây Thạnh - Tân Phú', 'lebuitantruong@gmail.com');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_donhang_taikhoan` (`iduser`);

--
-- Chỉ mục cho bảng `loaisp`
--
ALTER TABLE `loaisp`
  ADD PRIMARY KEY (`MaLoaiSP`);

--
-- Chỉ mục cho bảng `mau`
--
ALTER TABLE `mau`
  ADD PRIMARY KEY (`MaMau`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`MaSp`),
  ADD KEY `fk_MaMau` (`MaMau`),
  ADD KEY `fk_MaLoai` (`MaLoai`),
  ADD KEY `fk_MaSize` (`MaSize`);

--
-- Chỉ mục cho bảng `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`MaSize`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `donhang`
--
ALTER TABLE `donhang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `loaisp`
--
ALTER TABLE `loaisp`
  MODIFY `MaLoaiSP` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `mau`
--
ALTER TABLE `mau`
  MODIFY `MaMau` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `MaSp` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1152;

--
-- AUTO_INCREMENT cho bảng `size`
--
ALTER TABLE `size`
  MODIFY `MaSize` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `fk_donhang_taikhoan` FOREIGN KEY (`iduser`) REFERENCES `taikhoan` (`id`);

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `fk_MaLoai` FOREIGN KEY (`MaLoai`) REFERENCES `loaisp` (`MaLoaiSP`),
  ADD CONSTRAINT `fk_MaMau` FOREIGN KEY (`MaMau`) REFERENCES `mau` (`MaMau`),
  ADD CONSTRAINT `fk_MaSize` FOREIGN KEY (`MaSize`) REFERENCES `size` (`MaSize`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
