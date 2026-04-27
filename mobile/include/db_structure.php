<?
$sql[] = "
CREATE TABLE `erp_account` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '고유번호',
	`classification` VARCHAR(10) NOT NULL COMMENT '거래처구분',
	`account_cd` VARCHAR(50) NOT NULL COMMENT '거래처코드',
	`account_nm` VARCHAR(50) NOT NULL COMMENT '거래처명',
	`owner` VARCHAR(20) NOT NULL COMMENT '대표자명',
	`owner_mobile` VARCHAR(15) NULL DEFAULT NULL COMMENT '대표자휴대폰',
	`corp_reg_no` VARCHAR(20) NULL DEFAULT NULL COMMENT '사업자등록번호',
	`corp_condition` VARCHAR(50) NULL DEFAULT NULL COMMENT '업태',
	`corp_event` VARCHAR(50) NULL DEFAULT NULL COMMENT '종목',
	`corp_phone` VARCHAR(15) NULL DEFAULT NULL COMMENT '회사전화',
	`corp_fax` VARCHAR(15) NULL DEFAULT NULL COMMENT '회사팩스',
	`corp_email` VARCHAR(100) NULL DEFAULT NULL COMMENT '회사이메일',
	`corp_zipcode` VARCHAR(10) NULL DEFAULT NULL COMMENT '우편번호',
	`corp_address` VARCHAR(255) NULL DEFAULT NULL COMMENT '주소',
	`manager` VARCHAR(20) NULL DEFAULT NULL COMMENT '담당자',
	`bank` VARCHAR(20) NULL DEFAULT NULL COMMENT '은행',
	`account` VARCHAR(20) NULL DEFAULT NULL COMMENT '계좌',
	`account_id` VARCHAR(20) NULL DEFAULT NULL COMMENT '거래처아이디',
	`account_pwd` VARCHAR(20) NULL DEFAULT NULL COMMENT '거래처비밀번호',
	PRIMARY KEY (`uid`),
	INDEX `AC_CLASS` (`classification`, `account_cd`, `account_nm`)
)
COMMENT='거래처'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_account_classification` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`classify_nm` VARCHAR(50) NULL DEFAULT NULL COMMENT '구분명',
	`seq` INT(11) NULL DEFAULT NULL COMMENT '출력순서',
	PRIMARY KEY (`uid`)
)
COMMENT='거래처구분'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_admin` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`emp_id` VARCHAR(50) NOT NULL COMMENT '관리자 아이디',
	PRIMARY KEY (`uid`),
	INDEX `emp_id` (`emp_id`)
)
COMMENT='시스템관리자'
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_approval` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`approval_cd` VARCHAR(50) NULL DEFAULT '0' COMMENT '결제문서번호',
	`title` VARCHAR(100) NULL DEFAULT NULL COMMENT '기안제목',
	`approval_line` INT(11) NULL DEFAULT NULL COMMENT '결재라인',
	`refer` VARCHAR(50) NULL DEFAULT NULL COMMENT '참조',
	`comment` TEXT NULL COMMENT '내용',
	`purchase_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '구매요청코드',
	`estimate_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '견적서코드',
	`spending_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '지출결의서코드',
	`shipment_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '출하지시서코드',
	`attach` VARCHAR(255) NULL DEFAULT NULL COMMENT '첨부파일',
	`document` VARCHAR(50) NULL DEFAULT NULL COMMENT '문서양식',
	`state` VARCHAR(50) NULL DEFAULT NULL COMMENT '결재상태',
	`big_department_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '기안부서',
	`middle_department_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '기안부서',
	`small_department_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '기안부서',
	`emp_id` VARCHAR(50) NULL DEFAULT NULL COMMENT '기안자',
	`create_dt` DATETIME NOT NULL COMMENT '기안일',
	PRIMARY KEY (`uid`),
	INDEX `emp_id` (`emp_id`)
)
COMMENT='전자결재기안'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_approval_check` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`fid` INT(11) NOT NULL COMMENT '전자결재참조키',
	`emp_id` VARCHAR(50) NOT NULL COMMENT '결재자',
	`sign` CHAR(1) NOT NULL COMMENT '결재여부',
	`seq` INT(11) NOT NULL COMMENT '결재순서',
	`sign_dt` DATETIME NOT NULL COMMENT '결재일',
	PRIMARY KEY (`uid`),
	INDEX `fid` (`fid`, `emp_id`)
)
COMMENT='전자결재여부'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_approval_emp` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`fid` INT(11) NOT NULL COMMENT '결재라인테이블 참조키',
	`emp_id` VARCHAR(50) NOT NULL COMMENT '사원아이디',
	`seq` INT(11) NOT NULL COMMENT '결재순서',
	PRIMARY KEY (`uid`)
)
COMMENT='전자결재라인 사원'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_approval_line` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`approval_nm` VARCHAR(50) NULL DEFAULT NULL COMMENT '결재라인명',
	`emp_id` VARCHAR(50) NULL DEFAULT NULL COMMENT '등록자',
	PRIMARY KEY (`uid`)
)
COMMENT='전자결재라인'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_as` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`accept_dt` DATETIME NOT NULL COMMENT '접수일자',
	`state` VARCHAR(50) NOT NULL COMMENT '상태',
	`account_cd` VARCHAR(50) NOT NULL COMMENT '거래처코드',
	`account_nm` VARCHAR(50) NOT NULL COMMENT '거래처명',
	`account_manager` VARCHAR(50) NOT NULL COMMENT '거래처담당자',
	`email` VARCHAR(50) NOT NULL COMMENT '이메일',
	`phone` VARCHAR(50) NOT NULL COMMENT '연락처',
	`item_cd` VARCHAR(50) NOT NULL COMMENT '품목코드',
	`item_nm` VARCHAR(50) NOT NULL COMMENT '품목명',
	`faulty` VARCHAR(50) NOT NULL COMMENT '불량구분',
	`memo` TEXT NOT NULL COMMENT '내용',
	`as_result` TEXT NOT NULL COMMENT 'as결과',
	`processing` VARCHAR(50) NOT NULL COMMENT '처리방법',
	`processing_cost` INT(11) NOT NULL COMMENT '처리비용',
	`emp_id` VARCHAR(50) NOT NULL COMMENT '처리담당자아이디',
	`emp_nm` VARCHAR(50) NOT NULL COMMENT '처리담당자명',
	`create_dt` DATETIME NOT NULL COMMENT '등록일자',
	PRIMARY KEY (`uid`),
	INDEX `accept_dt` (`accept_dt`, `state`)
)
COMMENT='AS'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_authority` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`emp_id` VARCHAR(50) NOT NULL COMMENT '사원아이디',
	`item_menu` CHAR(1) NULL DEFAULT NULL COMMENT '품목관리',
	`account_menu` CHAR(1) NULL DEFAULT NULL COMMENT '거래처관리',
	`department_menu` CHAR(1) NULL DEFAULT NULL COMMENT '부서관리',
	`position_menu` CHAR(1) NULL DEFAULT NULL COMMENT '직위관리',
	`employee_menu` CHAR(1) NULL DEFAULT NULL COMMENT '사원관리',
	`warehouse_menu` CHAR(1) NULL DEFAULT NULL COMMENT '창고등록',
	`process_menu` CHAR(1) NULL DEFAULT NULL COMMENT '공정등록',
	`machine_menu` CHAR(1) NULL DEFAULT NULL COMMENT '생산기기등록',
	`project_menu` CHAR(1) NULL DEFAULT NULL COMMENT '프로젝트관리',
	`excel_menu` CHAR(1) NULL DEFAULT NULL COMMENT '엑셀자료등록',
	`trade_menu` CHAR(1) NULL DEFAULT NULL COMMENT '거래명세서',
	`estimate_menu` CHAR(1) NULL DEFAULT NULL COMMENT '견적관리',
	`order_menu` CHAR(1) NULL DEFAULT NULL COMMENT '수주(주문)관리',
	`shipment_menu` CHAR(1) NULL DEFAULT NULL COMMENT '출하관리',
	`as_menu` CHAR(1) NULL DEFAULT NULL COMMENT 'AS관리',
	`receive_menu` CHAR(1) NULL DEFAULT NULL COMMENT '미수금관리',
	`sale_plan_menu` CHAR(1) NULL DEFAULT NULL COMMENT '매출계획',
	`demand_menu` CHAR(1) NULL DEFAULT NULL COMMENT '구매요청',
	`purchase_plan_menu` CHAR(1) NULL DEFAULT NULL COMMENT '발주계획',
	`purchase_menu` CHAR(1) NULL DEFAULT NULL COMMENT '발주서',
	`purchase_item_menu` CHAR(1) NULL DEFAULT NULL COMMENT '구매(입고)',
	`amount_menu` CHAR(1) NULL DEFAULT NULL COMMENT '미지급금관리',
	`bom_menu` CHAR(1) NULL DEFAULT NULL COMMENT 'BOM(소요량)',
	`bom_cal_menu` CHAR(1) NULL DEFAULT NULL COMMENT 'BOM(소요량) 계산',
	`outsourcing_menu` CHAR(1) NULL DEFAULT NULL COMMENT '외주공장관리',
	`workplan_menu` CHAR(1) NULL DEFAULT NULL COMMENT '생산계획',
	`workplan_bom_menu` CHAR(1) NULL DEFAULT NULL COMMENT '생산계획별 소요 자재 현황 조회',
	`work_menu` CHAR(1) NULL DEFAULT NULL COMMENT '작업지시서',
	`qc_menu` CHAR(1) NULL DEFAULT NULL COMMENT '품질관리(QC)',
	`defective_menu` CHAR(1) NULL DEFAULT NULL COMMENT '불량관리',
	`warehouse_stock_menu` CHAR(1) NULL DEFAULT NULL COMMENT '창고재고관리',
	`price_menu` CHAR(1) NULL DEFAULT NULL COMMENT '단가관리',
	`stock_menu` CHAR(1) NULL DEFAULT NULL COMMENT '재고현황',
	`release_menu` CHAR(1) NULL DEFAULT NULL COMMENT '자재출고관리',
	`barcode_menu` CHAR(1) NULL DEFAULT NULL COMMENT '바코드관리',
	`real_stock_menu` CHAR(1) NULL DEFAULT NULL COMMENT '재고실사',
	`safety_menu` CHAR(1) NULL DEFAULT NULL COMMENT '안전재고관리',
	`ele_menu` CHAR(1) NULL DEFAULT NULL COMMENT '전자결재',
	`crm_menu` CHAR(1) NULL DEFAULT NULL COMMENT '고객관리(CRM)',
	`board_menu` CHAR(1) NULL DEFAULT NULL COMMENT '업무공유',
	`schedule_menu` CHAR(1) NULL DEFAULT NULL COMMENT '일정관리',
	`leave_menu` CHAR(1) NULL DEFAULT NULL COMMENT '출퇴근관리',
	`file_menu` CHAR(1) NULL DEFAULT NULL COMMENT '파일보관함',
	`goods_menu` CHAR(1) NULL DEFAULT NULL COMMENT '공용품관리',
	`car_menu` CHAR(1) NULL DEFAULT NULL COMMENT '차량관리',
	`installation_menu` CHAR(1) NULL DEFAULT NULL COMMENT '시설관리',
	PRIMARY KEY (`uid`)
)
COMMENT='메뉴사용설정'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_board` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`title` VARCHAR(50) NOT NULL COMMENT '제목',
	`classification` VARCHAR(50) NOT NULL COMMENT '업무구분',
	`attach` VARCHAR(255) NULL DEFAULT NULL COMMENT '첨부파일',
	`comment` TEXT NULL COMMENT '내용',
	`emp_id` VARCHAR(50) NOT NULL COMMENT '등록자',
	`create_dt` DATETIME NOT NULL COMMENT '등록일',
	PRIMARY KEY (`uid`),
	INDEX `title` (`title`, `classification`, `emp_id`)
)
COMMENT='업무공유함'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_bom` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`fid` INT(11) NOT NULL COMMENT '품목참조키',
	`item_cd` VARCHAR(255) NOT NULL COMMENT '품목코드',
	`item_nm` VARCHAR(255) NOT NULL COMMENT '품목명',
	`standard` VARCHAR(100) NULL DEFAULT NULL COMMENT '규격',
	`unit` VARCHAR(50) NULL DEFAULT NULL COMMENT '단위',
	`cnt` INT(11) NOT NULL COMMENT '소요량',
	PRIMARY KEY (`uid`),
	INDEX `fid` (`fid`)
)
COMMENT='BOM'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_buyer` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크 아이디',
	`fid` INT(11) NULL DEFAULT NULL COMMENT 'erp_item uid',
	`account_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '거래처코드',
	PRIMARY KEY (`uid`),
	INDEX `fid` (`fid`)
)
COMMENT='품목 구매처'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_car` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`car_no` VARCHAR(50) NULL DEFAULT NULL COMMENT '차량번호',
	`classification` VARCHAR(50) NULL DEFAULT NULL COMMENT '차량구분',
	`in_dt` DATETIME NULL DEFAULT NULL COMMENT '구입일',
	`charge_id` VARCHAR(50) NULL DEFAULT NULL COMMENT '담당자아이디',
	`charge_nm` VARCHAR(50) NULL DEFAULT NULL COMMENT '담당자명',
	PRIMARY KEY (`uid`),
	INDEX `uid` (`uid`)
)
COMMENT='차량관리'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_car_accident` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`fid` INT(11) NOT NULL COMMENT '차량참조키',
	`accident_dt` DATETIME NOT NULL COMMENT '사고일시',
	`accident_memo` VARCHAR(255) NOT NULL COMMENT '사고내용',
	`accident_result` VARCHAR(255) NOT NULL COMMENT '사고결과',
	PRIMARY KEY (`uid`),
	INDEX `fid` (`fid`)
)
COMMENT='차량사고이력'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_car_drive` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`fid` INT(11) NOT NULL COMMENT '차량참조키',
	`drive_dt` DATETIME NOT NULL COMMENT '운행일시',
	`drive_object` VARCHAR(255) NOT NULL COMMENT '운행목적',
	`drive_km` INT(11) NOT NULL COMMENT '운행거리',
	PRIMARY KEY (`uid`),
	INDEX `fid` (`fid`)
)
COMMENT='차량운행이력'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_car_service` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`fid` INT(11) NOT NULL COMMENT '차량참조키',
	`service_dt` DATETIME NOT NULL COMMENT '정비일시',
	`service_memo` VARCHAR(255) NOT NULL COMMENT '정비내용',
	`service_cost` INT(11) NOT NULL COMMENT '정비비용',
	PRIMARY KEY (`uid`),
	INDEX `fid` (`fid`)
)
COMMENT='차량정비이력'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_company` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`company_nm` VARCHAR(50) NULL DEFAULT NULL COMMENT '회사명',
	`owner` VARCHAR(50) NULL DEFAULT NULL COMMENT '대표',
	`business_no` VARCHAR(50) NULL DEFAULT NULL COMMENT '사업자등록번호',
	`telephone` VARCHAR(50) NULL DEFAULT NULL COMMENT '대표전화',
	`fax` VARCHAR(50) NULL DEFAULT NULL COMMENT '팩스',
	`zipcode` VARCHAR(50) NULL DEFAULT NULL COMMENT '우편번호',
	`address` VARCHAR(100) NULL DEFAULT NULL COMMENT '주소',
	`corp_type` VARCHAR(50) NULL DEFAULT NULL COMMENT '업태',
	`corp_event` VARCHAR(50) NULL DEFAULT NULL COMMENT '종목',
	PRIMARY KEY (`uid`)
)
COMMENT='회사정보'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_config` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT,
	`auto_purchase` CHAR(1) NULL DEFAULT NULL COMMENT '자동으로 발주서 작성',
	`auto_work` CHAR(1) NULL DEFAULT NULL COMMENT '작업지시서 강제출력',
	`auto_release` CHAR(1) NULL DEFAULT NULL COMMENT '자동자재불출',
	`auto_lotno` CHAR(1) NULL DEFAULT NULL COMMENT 'lotno 자동생성',
	`auto_barcode` CHAR(1) NULL DEFAULT NULL COMMENT '바코드시스템사용',
	`auto_code` CHAR(1) NULL DEFAULT NULL COMMENT '각종코드자동생성',
	`auto_project` CHAR(1) NULL DEFAULT NULL COMMENT '프로젝트기본',
	`auto_warehouse` CHAR(1) NULL DEFAULT NULL COMMENT '기본자재창고사용',
	PRIMARY KEY (`uid`)
)
COMMENT='ERP 환경설정'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_copperplate` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`copperplate_size` VARCHAR(50) NULL DEFAULT NULL COMMENT '동판규격',
	PRIMARY KEY (`uid`)
)
COMMENT='동판규격'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_counsel` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`fid` INT(11) NULL DEFAULT NULL COMMENT '고객참조키',
	`counsel_classification` VARCHAR(50) NULL DEFAULT NULL COMMENT '상담구분',
	`counsel_dt` DATETIME NULL DEFAULT NULL COMMENT '상담일',
	`counsel` TEXT NULL COMMENT '상담내용',
	`emp_id` VARCHAR(50) NULL DEFAULT NULL COMMENT '등록자',
	`create_dt` DATETIME NULL DEFAULT NULL COMMENT '등록일',
	PRIMARY KEY (`uid`)
)
COMMENT='CRM 상담'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_customer` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`customer_nm` VARCHAR(50) NOT NULL COMMENT '고객명',
	`classification` VARCHAR(50) NOT NULL COMMENT '고객구분',
	`customer_phone` VARCHAR(50) NULL DEFAULT NULL COMMENT '연락처',
	`customer_email` VARCHAR(100) NULL DEFAULT NULL COMMENT '이메일',
	`customer_birthday` DATETIME NULL DEFAULT NULL COMMENT '생일',
	`customer_zipcode` VARCHAR(50) NULL DEFAULT NULL COMMENT '우편번호',
	`customer_address` VARCHAR(100) NULL DEFAULT NULL COMMENT '주소',
	`emp_id` VARCHAR(50) NOT NULL COMMENT '등록자',
	`create_dt` DATETIME NOT NULL COMMENT '등록일',
	PRIMARY KEY (`uid`)
)
COMMENT='고객CRM'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_daily_worker` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`emp_gb` VARCHAR(10) NOT NULL COMMENT '재직/퇴사',
	`emp_cd` VARCHAR(20) NOT NULL COMMENT '사원코드',
	`emp_nm` VARCHAR(20) NOT NULL COMMENT '사원명',
	`emp_id` VARCHAR(20) NOT NULL COMMENT '아이디',
	`emp_pwd` VARCHAR(20) NOT NULL COMMENT '비밀번호',
	`sex_gb` CHAR(1) NULL DEFAULT NULL COMMENT '성별',
	`regist_no` VARCHAR(20) NULL DEFAULT NULL COMMENT '주민등록번호',
	`emp_mobile` VARCHAR(20) NOT NULL COMMENT '휴대전화',
	`emp_telephone` VARCHAR(20) NULL DEFAULT NULL COMMENT '자택전화',
	`emp_email` VARCHAR(50) NULL DEFAULT NULL COMMENT '이메일',
	`join_dt` DATETIME NULL DEFAULT NULL COMMENT '입사일',
	`resign_dt` DATETIME NULL DEFAULT NULL COMMENT '퇴사일',
	`emp_zipcode` VARCHAR(20) NULL DEFAULT NULL COMMENT '우편번호',
	`emp_address` VARCHAR(100) NULL DEFAULT NULL COMMENT '주소',
	`pay_gb` VARCHAR(20) NULL DEFAULT NULL COMMENT '급여구분',
	`health_ins` VARCHAR(20) NULL DEFAULT NULL COMMENT '건강보험',
	`national_pension` VARCHAR(20) NULL DEFAULT NULL COMMENT '국민연금',
	`eldelry_ins` VARCHAR(20) NULL DEFAULT NULL COMMENT '노인보험감면',
	`unemployment_ins` VARCHAR(20) NULL DEFAULT NULL COMMENT '고용보험',
	`occupation` VARCHAR(20) NULL DEFAULT NULL COMMENT '직종구분',
	`nationality` VARCHAR(20) NULL DEFAULT NULL COMMENT '국적정보',
	`create_dt` DATETIME NOT NULL COMMENT '등록일',
	PRIMARY KEY (`uid`),
	INDEX `emp_cd` (`emp_cd`, `emp_nm`, `emp_id`, `emp_pwd`)
)
COMMENT='사원'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_defective` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`fid` INT(11) NULL DEFAULT '0' COMMENT 'work_report 참조키',
	`item_cd` VARCHAR(50) NULL DEFAULT '0' COMMENT '생산품목코드',
	`item_nm` VARCHAR(50) NULL DEFAULT '0' COMMENT '생산품목명',
	`standard` VARCHAR(50) NULL DEFAULT '0' COMMENT '생산품목규격',
	`defect_item_cd` VARCHAR(50) NULL DEFAULT '0' COMMENT '불량원인품목코드',
	`defect_item_nm` VARCHAR(50) NULL DEFAULT '0' COMMENT '불량원인품목명',
	`defect_item_standard` VARCHAR(50) NULL DEFAULT '0' COMMENT '불량원인품목규격',
	`defective` VARCHAR(50) NULL DEFAULT '0' COMMENT '불량사유',
	`defect_cnt` INT(11) NULL DEFAULT '0' COMMENT '불량수량',
	`defect_process` VARCHAR(50) NULL DEFAULT '0' COMMENT '불량처리방법',
	`memo` VARCHAR(50) NULL DEFAULT '0' COMMENT '비고',
	PRIMARY KEY (`uid`),
	INDEX `fid` (`fid`)
)
COMMENT='불량관리'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_defect_reason` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`reason` VARCHAR(50) NULL DEFAULT NULL COMMENT '불량사유',
	PRIMARY KEY (`uid`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_department_big` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`department_nm` VARCHAR(50) NOT NULL COMMENT '직위명',
	`seq` INT(11) NULL DEFAULT '0' COMMENT '출력순서',
	PRIMARY KEY (`uid`)
)
COMMENT='부서'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_department_middle` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`fid` INT(11) NULL DEFAULT '0' COMMENT '상위부서유니크아이디',
	`department_nm` VARCHAR(50) NOT NULL COMMENT '직위명',
	`seq` INT(11) NULL DEFAULT '0' COMMENT '출력순서',
	PRIMARY KEY (`uid`)
)
COMMENT='부서'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
ROW_FORMAT=COMPACT
";

$sql[] = "
CREATE TABLE `erp_department_small` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`fid` INT(11) NULL DEFAULT '0' COMMENT '상위부서유니크아이디',
	`department_nm` VARCHAR(50) NOT NULL COMMENT '직위명',
	`seq` INT(11) NULL DEFAULT '0' COMMENT '출력순서',
	PRIMARY KEY (`uid`)
)
COMMENT='부서'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
ROW_FORMAT=COMPACT
";

$sql[] = "
CREATE TABLE `erp_deposit` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`fid` INT(11) NULL DEFAULT NULL COMMENT 'erp_order uid',
	`price` INT(11) NULL DEFAULT NULL COMMENT '수금액',
	`create_dt` DATETIME NULL DEFAULT NULL COMMENT '수금일자',
	PRIMARY KEY (`uid`)
)
COMMENT='수금내역'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_direction` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`direction` VARCHAR(50) NULL DEFAULT NULL COMMENT '풀림방향',
	PRIMARY KEY (`uid`)
)
COMMENT='완제품 풀림방향'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_document` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`classification` VARCHAR(50) NULL DEFAULT NULL COMMENT '문서구분',
	`title` VARCHAR(255) NULL DEFAULT NULL COMMENT '제목',
	`comment` TEXT NULL COMMENT '내용',
	`emp_id` VARCHAR(50) NULL DEFAULT NULL COMMENT '등록자',
	`create_dt` DATETIME NULL DEFAULT NULL COMMENT '등록일',
	PRIMARY KEY (`uid`),
	INDEX `emp_id` (`emp_id`)
)
COMMENT='결재문서양식'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_employee` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`classification` VARCHAR(10) NOT NULL COMMENT '재직/퇴사',
	`emp_cd` VARCHAR(20) NOT NULL COMMENT '사원코드',
	`emp_nm` VARCHAR(20) NOT NULL COMMENT '사원명',
	`emp_id` VARCHAR(20) NOT NULL COMMENT '아이디',
	`emp_pwd` VARCHAR(20) NOT NULL COMMENT '비밀번호',
	`sex` CHAR(1) NULL DEFAULT NULL COMMENT '성별',
	`regist_no` VARCHAR(20) NULL DEFAULT NULL COMMENT '주민등록번호',
	`emp_mobile` VARCHAR(20) NOT NULL COMMENT '휴대전화',
	`emp_telephone` VARCHAR(20) NULL DEFAULT NULL COMMENT '자택전화',
	`emp_email` VARCHAR(50) NULL DEFAULT NULL COMMENT '이메일',
	`join_dt` DATETIME NULL DEFAULT NULL COMMENT '입사일',
	`resign_dt` DATETIME NULL DEFAULT NULL COMMENT '퇴사일',
	`big_department_cd` INT(11) NULL DEFAULT NULL COMMENT '부서코드',
	`middle_department_cd` INT(11) NULL DEFAULT NULL COMMENT '부서코드',
	`small_department_cd` INT(11) NULL DEFAULT NULL COMMENT '부서코드',
	`position_cd` INT(11) NULL DEFAULT NULL COMMENT '직위코드',
	`emp_zipcode` VARCHAR(20) NULL DEFAULT NULL COMMENT '우편번호',
	`emp_address` VARCHAR(100) NULL DEFAULT NULL COMMENT '주소',
	`img` VARCHAR(255) NULL DEFAULT NULL COMMENT '사진',
	PRIMARY KEY (`uid`),
	INDEX `emp_cd` (`emp_cd`, `emp_nm`, `emp_id`, `emp_pwd`)
)
COMMENT='사원'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_estimate` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`estimate_cd` VARCHAR(50) NOT NULL COMMENT '견적서코드',
	`estimate_dt` DATETIME NOT NULL COMMENT '견적일자',
	`account_cd` VARCHAR(50) NOT NULL COMMENT '발주처코드',
	`obtain_account_cd` VARCHAR(50) NOT NULL COMMENT '수주처코드',
	`sales_emp_id` VARCHAR(50) NOT NULL COMMENT '영업담당자아이디',
	`manager` VARCHAR(50) NULL DEFAULT NULL COMMENT '거래처담당자',
	`warehouse_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '자재입고창고코드',
	`tax_type` INT(11) NOT NULL COMMENT '부가세유무',
	`currency` INT(11) NOT NULL COMMENT '통화단위',
	`project_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '프로젝트코드',
	`refer` TEXT NULL COMMENT '참조',
	`payment_condition` VARCHAR(50) NULL DEFAULT NULL COMMENT '결제조건',
	`delivery_dt` DATETIME NULL DEFAULT NULL COMMENT '납품기한',
	`attach` VARCHAR(255) NULL DEFAULT NULL COMMENT '첨부파일',
	`final` CHAR(1) NOT NULL COMMENT '최종선택여부',
	`used` CHAR(1) NOT NULL COMMENT '사용여부',
	`emp_id` VARCHAR(50) NULL DEFAULT NULL COMMENT '등록자',
	`create_dt` DATETIME NOT NULL COMMENT '등록일',
	PRIMARY KEY (`uid`),
	INDEX `estimate_dt` (`estimate_dt`, `account_cd`, `project_cd`, `delivery_dt`)
)
COMMENT='견적서'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";


$sql[] = "
CREATE TABLE `erp_estimate_item` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`fid` INT(11) NOT NULL COMMENT '견적서참조키',
	`item_cd` VARCHAR(255) NOT NULL COMMENT '아이템코드',
	`item_nm` VARCHAR(255) NOT NULL COMMENT '아이템명',
	`standard` VARCHAR(100) NULL DEFAULT NULL COMMENT '규격',
	`cnt` INT(11) NOT NULL COMMENT '수량',
	`sale_price` INT(11) NOT NULL COMMENT '판매단가',
	`tariff` FLOAT NOT NULL COMMENT '요율',
	`adjustments` INT(11) NOT NULL COMMENT '조정단가',
	`supply_price` INT(11) NOT NULL COMMENT '공급가',
	`tax` INT(11) NOT NULL COMMENT '부가세',
	`total_price` INT(11) NOT NULL COMMENT '합계금액',
	PRIMARY KEY (`uid`),
	INDEX `fid` (`fid`)
)
COMMENT='견적서 품목'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_fabricating` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`fabricating_nm` VARCHAR(50) NULL DEFAULT NULL COMMENT '가공형태',
	PRIMARY KEY (`uid`)
)
COMMENT='가공형태'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_file` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`title` VARCHAR(255) NULL DEFAULT NULL COMMENT '파일제목',
	`classification` VARCHAR(50) NULL DEFAULT NULL COMMENT '구분',
	`attach` VARCHAR(255) NULL DEFAULT NULL COMMENT '첨부파일',
	`emp_id` VARCHAR(50) NULL DEFAULT NULL COMMENT '등록자',
	`create_dt` DATETIME NULL DEFAULT NULL COMMENT '등록일',
	PRIMARY KEY (`uid`),
	INDEX `emp_id` (`emp_id`)
)
COMMENT='파일보관함'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_info` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`corp_nm` VARCHAR(50) NULL DEFAULT NULL COMMENT '회사명',
	`business_no` VARCHAR(50) NULL DEFAULT NULL COMMENT '사업자등록번호',
	`owner` VARCHAR(50) NULL DEFAULT NULL COMMENT '대표',
	`telephone` VARCHAR(50) NULL DEFAULT NULL COMMENT '대표전화',
	`fax` VARCHAR(50) NULL DEFAULT NULL COMMENT '팩스',
	`address` VARCHAR(100) NULL DEFAULT NULL COMMENT '주소',
	`corp_type` VARCHAR(50) NULL DEFAULT NULL COMMENT '업태',
	`corp_event` VARCHAR(50) NULL DEFAULT NULL COMMENT '종목',
	`sign` VARCHAR(50) NULL DEFAULT NULL COMMENT '도장',
	`admin` VARCHAR(50) NULL DEFAULT NULL COMMENT '관리자아이디',
	PRIMARY KEY (`uid`)
)
COMMENT='회사정보'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_installation` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`item_nm` VARCHAR(50) NOT NULL COMMENT '공용품명',
	`classification` VARCHAR(50) NOT NULL COMMENT '공용품구분',
	`in_dt` DATETIME NOT NULL COMMENT '도입일',
	`change_day` INT(11) NOT NULL COMMENT '교환일',
	`change_classification` VARCHAR(50) NOT NULL COMMENT '교환단위',
	`alarm_dt` DATETIME NOT NULL COMMENT '교환알림일자',
	`charge_id` VARCHAR(50) NOT NULL COMMENT '담당자아이디',
	`charge_nm` VARCHAR(50) NOT NULL COMMENT '담당자명',
	`attach` VARCHAR(255) NOT NULL COMMENT '첨부파일',
	`create_dt` DATETIME NOT NULL COMMENT '작성일',
	PRIMARY KEY (`uid`),
	INDEX `item_nm` (`item_nm`, `classification`)
)
COMMENT='시설관리'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_in_item` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`fid` INT(11) NULL DEFAULT NULL COMMENT 'work_report 참조키',
	`item_cd` VARCHAR(255) NULL DEFAULT NULL COMMENT '품목코드',
	`item_nm` VARCHAR(255) NULL DEFAULT NULL COMMENT '품목명',
	`standard` VARCHAR(100) NULL DEFAULT NULL COMMENT '품목규격',
	`bom_cnt` INT(11) NULL DEFAULT NULL COMMENT 'BOM소요량',
	`in_cnt` INT(11) NULL DEFAULT NULL COMMENT '실투입량',
	`lotno` VARCHAR(50) NULL DEFAULT NULL COMMENT 'LotNo',
	PRIMARY KEY (`uid`),
	INDEX `fid` (`fid`)
)
COMMENT='작업투입자재'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_item` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '고유번호',
	`item_cd` VARCHAR(255) NOT NULL COMMENT '품목코드',
	`item_nm` VARCHAR(255) NOT NULL COMMENT '품목명',
	`unit` VARCHAR(50) NULL DEFAULT NULL COMMENT '단위',
	`standard` VARCHAR(100) NULL DEFAULT NULL COMMENT '규격',
	`delivery_period` INT(11) NULL DEFAULT '0' COMMENT '조달기간',
	`stock_cnt` INT(11) NULL DEFAULT '0' COMMENT '재고수량',
	`safety_stock_cnt` INT(11) NULL DEFAULT '0' COMMENT '안전재고수량',
	`classification` VARCHAR(50) NULL DEFAULT NULL COMMENT '품목구분',
	`group_cd` VARCHAR(50) NULL DEFAULT '0' COMMENT '아이템 그룹코드',
	`barcode` VARCHAR(255) NULL DEFAULT NULL COMMENT '바코드',
	`img` VARCHAR(255) NULL DEFAULT NULL COMMENT '이미지',
	PRIMARY KEY (`uid`),
	INDEX `ITEM_CD` (`item_cd`, `item_nm`)
)
COMMENT='품목테이블'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_item_classification` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`classify_nm` VARCHAR(50) NULL DEFAULT NULL COMMENT '품목구분명',
	`seq` INT(11) NULL DEFAULT NULL COMMENT '출력순서',
	PRIMARY KEY (`uid`)
)
COMMENT='품목구분관리'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_item_etc` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`item_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '품목코드',
	`standard` VARCHAR(50) NULL DEFAULT NULL COMMENT '규격',
	`dosu` INT(11) NULL DEFAULT NULL COMMENT '총후도',
	`copperplate` VARCHAR(50) NULL DEFAULT NULL COMMENT '동판규격',
	`color` INT(11) NULL DEFAULT NULL COMMENT '색도',
	`fabricating` VARCHAR(50) NULL DEFAULT NULL COMMENT '가공형태',
	`direction` VARCHAR(50) NULL DEFAULT NULL COMMENT '완제품 풀림방향',
	`srite` VARCHAR(50) NULL DEFAULT NULL COMMENT '제품규격/스릿트폭',
	PRIMARY KEY (`uid`)
)
COMMENT='품목입력 기타입력값'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_item_group` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`group_nm` VARCHAR(50) NULL DEFAULT NULL COMMENT '그룹명',
	`seq` INT(11) NULL DEFAULT NULL COMMENT '출력순서',
	PRIMARY KEY (`uid`)
)
COMMENT='품목그룹'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_item_material` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`item_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '품목코드',
	`standard` VARCHAR(50) NULL DEFAULT NULL COMMENT '규격',
	`size1` VARCHAR(50) NULL DEFAULT NULL COMMENT '1급지',
	`size2` VARCHAR(50) NULL DEFAULT NULL COMMENT '2급지',
	`size3` VARCHAR(50) NULL DEFAULT NULL COMMENT '3급지',
	PRIMARY KEY (`uid`)
)
COMMENT='원단규격'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_item_price` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`gid` INT(11) NOT NULL DEFAULT '0' COMMENT 'erp_item 참조키',
	`fid` INT(11) NULL DEFAULT NULL COMMENT 'erp_stock 참조키',
	`purchase_price` INT(11) NULL DEFAULT NULL COMMENT '구매단가',
	`sale_price` INT(11) NULL DEFAULT NULL COMMENT '판매단가',
	`create_dt` DATETIME NULL DEFAULT NULL COMMENT '기록일',
	PRIMARY KEY (`uid`),
	INDEX `fid` (`fid`),
	INDEX `gid` (`gid`)
)
COMMENT='품목단가변동표'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_item_process` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`fid` INT(11) NOT NULL DEFAULT '0' COMMENT '품목참조키',
	`item_cd` VARCHAR(50) NULL DEFAULT '0' COMMENT '품목코드',
	`standard` VARCHAR(50) NULL DEFAULT '0' COMMENT '규격',
	`seq` INT(11) NULL DEFAULT '0' COMMENT '공정순서',
	`process` VARCHAR(50) NULL DEFAULT '0' COMMENT '공정',
	`process_item_cd` VARCHAR(50) NULL DEFAULT '0' COMMENT '생산품목코드',
	`process_item_nm` VARCHAR(50) NULL DEFAULT '0' COMMENT '생산품명',
	`process_standard` VARCHAR(50) NULL DEFAULT '0' COMMENT '생산규격',
	`process_cnt` INT(11) NULL DEFAULT '0' COMMENT '소요량',
	PRIMARY KEY (`uid`)
)
COMMENT='생산품목 작업공정'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_item_quality` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`item_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '품목코드',
	`standard` VARCHAR(50) NULL DEFAULT NULL COMMENT '규격',
	`material` VARCHAR(50) NULL DEFAULT NULL COMMENT '재질',
	PRIMARY KEY (`uid`)
)
COMMENT='재질구성'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_machine` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`process_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '공정코드',
	`machine_nm` VARCHAR(50) NULL DEFAULT NULL COMMENT '기기명',
	PRIMARY KEY (`uid`),
	INDEX `process_cd` (`process_cd`)
)
COMMENT='기기등록'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_manpower` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`machine_nm` VARCHAR(50) NULL DEFAULT NULL COMMENT '기계명(사람명)',
	`process_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '투입공정코드',
	`process_nm` VARCHAR(50) NULL DEFAULT NULL COMMENT '투입공정명',
	`item_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '생산품목코드',
	`item_nm` VARCHAR(50) NULL DEFAULT NULL COMMENT '생산품목명',
	`standard` VARCHAR(50) NULL DEFAULT NULL COMMENT '생산품규격',
	`work_start_time` DATETIME NULL DEFAULT NULL COMMENT '작업시작시간',
	`work_end_time` DATETIME NULL DEFAULT NULL COMMENT '작업종료시간',
	`total_work_time` INT(11) NULL DEFAULT NULL COMMENT '투입시간',
	PRIMARY KEY (`uid`),
	INDEX `machine_nm` (`machine_nm`)
)
COMMENT='투입공수'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_material_size` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`material` VARCHAR(50) NULL DEFAULT NULL COMMENT '원단종류',
	`size` VARCHAR(50) NULL DEFAULT NULL COMMENT '원단규격',
	PRIMARY KEY (`uid`)
)
COMMENT='원단규격'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_menu` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`item_menu` CHAR(1) NULL DEFAULT NULL COMMENT '품목관리',
	`account_menu` CHAR(1) NULL DEFAULT NULL COMMENT '거래처관리',
	`department_menu` CHAR(1) NULL DEFAULT NULL COMMENT '부서관리',
	`position_menu` CHAR(1) NULL DEFAULT NULL COMMENT '직위관리',
	`employee_menu` CHAR(1) NULL DEFAULT NULL COMMENT '사원관리',
	`warehouse_menu` CHAR(1) NULL DEFAULT NULL COMMENT '창고등록',
	`process_menu` CHAR(1) NULL DEFAULT NULL COMMENT '공정등록',
	`machine_menu` CHAR(1) NULL DEFAULT NULL COMMENT '생산기기등록',
	`project_menu` CHAR(1) NULL DEFAULT NULL COMMENT '프로젝트관리',
	`excel_menu` CHAR(1) NULL DEFAULT NULL COMMENT '엑셀자료등록',
	`trade_menu` CHAR(1) NULL DEFAULT NULL COMMENT '거래명세서',
	`estimate_menu` CHAR(1) NULL DEFAULT NULL COMMENT '견적관리',
	`order_menu` CHAR(1) NULL DEFAULT NULL COMMENT '수주(주문)관리',
	`shipment_menu` CHAR(1) NULL DEFAULT NULL COMMENT '출하관리',
	`as_menu` CHAR(1) NULL DEFAULT NULL COMMENT 'AS관리',
	`receive_menu` CHAR(1) NULL DEFAULT NULL COMMENT '미수금관리',
	`sale_plan_menu` CHAR(1) NULL DEFAULT NULL COMMENT '매출계획',
	`demand_menu` CHAR(1) NULL DEFAULT NULL COMMENT '구매요청',
	`purchase_plan_menu` CHAR(1) NULL DEFAULT NULL COMMENT '발주계획',
	`purchase_menu` CHAR(1) NULL DEFAULT NULL COMMENT '발주서',
	`purchase_item_menu` CHAR(1) NULL DEFAULT NULL COMMENT '구매(입고)',
	`amount_menu` CHAR(1) NULL DEFAULT NULL COMMENT '미지급금관리',
	`bom_menu` CHAR(1) NULL DEFAULT NULL COMMENT 'BOM(소요량)',
	`bom_cal_menu` CHAR(1) NULL DEFAULT NULL COMMENT 'BOM(소요량) 계산',
	`outsourcing_menu` CHAR(1) NULL DEFAULT NULL COMMENT '외주공장관리',
	`workplan_menu` CHAR(1) NULL DEFAULT NULL COMMENT '생산계획',
	`workplan_bom_menu` CHAR(1) NULL DEFAULT NULL COMMENT '생산계획별 소요 자재 현황 조회',
	`work_menu` CHAR(1) NULL DEFAULT NULL COMMENT '작업지시서',
	`qc_menu` CHAR(1) NULL DEFAULT NULL COMMENT '품질관리(QC)',
	`defective_menu` CHAR(1) NULL DEFAULT NULL COMMENT '불량관리',
	`warehouse_stock_menu` CHAR(1) NULL DEFAULT NULL COMMENT '창고재고관리',
	`price_menu` CHAR(1) NULL DEFAULT NULL COMMENT '단가관리',
	`stock_menu` CHAR(1) NULL DEFAULT NULL COMMENT '재고현황',
	`release_menu` CHAR(1) NULL DEFAULT NULL COMMENT '자재출고관리',
	`barcode_menu` CHAR(1) NULL DEFAULT NULL COMMENT '바코드관리',
	`real_stock_menu` CHAR(1) NULL DEFAULT NULL COMMENT '재고실사',
	`safety_menu` CHAR(1) NULL DEFAULT NULL COMMENT '안전재고관리',
	`ele_menu` CHAR(1) NULL DEFAULT NULL COMMENT '전자결재',
	`crm_menu` CHAR(1) NULL DEFAULT NULL COMMENT '고객관리(CRM)',
	`board_menu` CHAR(1) NULL DEFAULT NULL COMMENT '업무공유',
	`schedule_menu` CHAR(1) NULL DEFAULT NULL COMMENT '일정관리',
	`leave_menu` CHAR(1) NULL DEFAULT NULL COMMENT '출퇴근관리',
	`file_menu` CHAR(1) NULL DEFAULT NULL COMMENT '파일보관함',
	`goods_menu` CHAR(1) NULL DEFAULT NULL COMMENT '공용품관리',
	`car_menu` CHAR(1) NULL DEFAULT NULL COMMENT '차량관리',
	`installation_menu` CHAR(1) NULL DEFAULT NULL COMMENT '시설관리',
	PRIMARY KEY (`uid`)
)
COMMENT='메뉴사용설정'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_mold` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT,
	`a` VARCHAR(50) NULL DEFAULT NULL COMMENT '금형코드',
	`b` VARCHAR(50) NULL DEFAULT NULL COMMENT '도면코드',
	`c` VARCHAR(50) NULL DEFAULT NULL COMMENT '구분',
	`d` VARCHAR(50) NULL DEFAULT NULL COMMENT '금형차수',
	`e` DATETIME NULL DEFAULT NULL COMMENT '제작일자',
	`f` VARCHAR(50) NULL DEFAULT NULL COMMENT '명칭',
	`g` VARCHAR(50) NULL DEFAULT NULL COMMENT '사출기용량',
	`h` VARCHAR(50) NULL DEFAULT NULL COMMENT '모델명',
	`i` VARCHAR(50) NULL DEFAULT NULL COMMENT '규격',
	`j` VARCHAR(50) NULL DEFAULT NULL COMMENT '금형형식',
	`k` VARCHAR(50) NULL DEFAULT NULL COMMENT '금형SIZE',
	`l` VARCHAR(50) NULL DEFAULT NULL COMMENT '제작비',
	`m` VARCHAR(50) NULL DEFAULT NULL COMMENT '수명(쇼트)',
	`n` VARCHAR(50) NULL DEFAULT NULL COMMENT '누적쇼트수',
	`o` VARCHAR(50) NULL DEFAULT NULL COMMENT '캐비티',
	`p` VARCHAR(50) NULL DEFAULT NULL COMMENT '제품중량',
	`q` VARCHAR(50) NULL DEFAULT NULL COMMENT '스크랩중량',
	`r` VARCHAR(50) NULL DEFAULT NULL COMMENT '성형시간',
	`s` TEXT NULL COMMENT '메모',
	`account_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '제작회사',
	PRIMARY KEY (`uid`)
)
COMMENT='금형정보'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_order` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`order_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '주문서코드',
	`estimate_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '견적서코드',
	`account_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '거래처코드',
	`obtain_account_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '수주처코드',
	`sales_emp_id` VARCHAR(50) NULL DEFAULT NULL COMMENT '영업담당자아이디',
	`manager` VARCHAR(50) NULL DEFAULT NULL COMMENT '거래처담당자',
	`warehouse_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '자재입고창고코드',
	`tax_type` INT(11) NULL DEFAULT NULL COMMENT '부가세유무',
	`currency` INT(11) NULL DEFAULT NULL COMMENT '통화단위',
	`project_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '프로젝트코드',
	`refer` TEXT NULL COMMENT '참조',
	`payment_condition` VARCHAR(50) NULL DEFAULT NULL COMMENT '결제조건',
	`delivery_dt` DATETIME NULL DEFAULT NULL COMMENT '납품기한',
	`attach` VARCHAR(255) NULL DEFAULT NULL COMMENT '첨부파일',
	`state` VARCHAR(50) NULL DEFAULT NULL COMMENT '납품완료여부',
	`receivable` CHAR(50) NULL DEFAULT NULL COMMENT '미수금여부',
	`receivable_price` BIGINT(20) NULL DEFAULT NULL COMMENT '미수금액',
	`warehousing_state` VARCHAR(50) NULL DEFAULT NULL COMMENT '입고상태',
	`emp_id` VARCHAR(50) NULL DEFAULT NULL COMMENT '등록자',
	`create_dt` DATETIME NULL DEFAULT NULL COMMENT '등록일',
	PRIMARY KEY (`uid`),
	INDEX `estimate_dt` (`account_cd`, `project_cd`, `delivery_dt`)
)
COMMENT='수주서'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_order_draft` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`fid` INT(11) NULL DEFAULT '0' COMMENT 'erp_purchase uid',
	`item_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '품목코드',
	`standard` VARCHAR(50) NULL DEFAULT NULL COMMENT '규격',
	`unit` VARCHAR(50) NULL DEFAULT NULL COMMENT '단위',
	`barcode` VARCHAR(50) NULL DEFAULT NULL COMMENT '바코드',
	`cnt` INT(11) NULL DEFAULT NULL COMMENT '발주수량',
	`purchase_price` INT(11) NULL DEFAULT NULL COMMENT '단가',
	`total_price` INT(11) NULL DEFAULT NULL COMMENT '합계금액',
	`account_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '거래처코드',
	`warehouse_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '입고창고코드',
	`state` VARCHAR(50) NULL DEFAULT NULL COMMENT '입고상태',
	`create_dt` DATETIME NULL DEFAULT NULL COMMENT '발주확정일',
	PRIMARY KEY (`uid`)
)
COMMENT='발주서'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_order_draft_plan` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`title` VARCHAR(50) NULL DEFAULT NULL COMMENT '제목',
	`total_price` INT(11) NULL DEFAULT NULL COMMENT '합계금액',
	`state` VARCHAR(50) NULL DEFAULT NULL COMMENT '상태',
	`create_dt` DATETIME NULL DEFAULT NULL COMMENT '등록일',
	PRIMARY KEY (`uid`)
)
COMMENT='발주계획서'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_order_item` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`fid` INT(11) NULL DEFAULT NULL COMMENT '주문서참조키',
	`item_cd` VARCHAR(255) NULL DEFAULT NULL COMMENT '아이템코드',
	`item_nm` VARCHAR(255) NULL DEFAULT NULL COMMENT '아이템명',
	`standard` VARCHAR(100) NULL DEFAULT NULL COMMENT '규격',
	`cnt` INT(11) NULL DEFAULT NULL COMMENT '수량',
	`out_cnt` INT(11) NULL DEFAULT NULL COMMENT '출하된수량',
	`remain_cnt` INT(11) NULL DEFAULT NULL COMMENT '잔여출하수량',
	`sale_price` INT(11) NULL DEFAULT NULL COMMENT '판매단가',
	`tariff` FLOAT NULL DEFAULT NULL COMMENT '요율',
	`adjustments` INT(11) NULL DEFAULT NULL COMMENT '조정단가',
	`supply_price` INT(11) NULL DEFAULT NULL COMMENT '공급가액',
	`tax` INT(11) NULL DEFAULT NULL COMMENT '부가세',
	`total_price` INT(11) NULL DEFAULT NULL COMMENT '합계금액',
	`state` VARCHAR(50) NULL DEFAULT NULL COMMENT '작업지시상태',
	`shipment` VARCHAR(50) NULL DEFAULT 'n' COMMENT '출하여부',
	`draft` VARCHAR(50) NULL DEFAULT 'n' COMMENT '자재구매요청여부',
	PRIMARY KEY (`uid`),
	INDEX `fid` (`fid`)
)
COMMENT='수주품목'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_outsourcing` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`work_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '작업지시서코드',
	`order_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '수주서코드',
	`release_type` VARCHAR(50) NULL DEFAULT NULL COMMENT '사급방법',
	`account_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '거래처코드',
	`warehouse_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '창고코드',
	`expectation_warehousing_dt` DATETIME NULL DEFAULT NULL COMMENT '입고희망일',
	`emp_id` VARCHAR(50) NULL DEFAULT NULL COMMENT '발주담당자',
	`create_dt` DATETIME NULL DEFAULT NULL COMMENT '발주일',
	PRIMARY KEY (`uid`)
)
COMMENT='외주발주서'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_outsourcing_item` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`fid` INT(11) NULL DEFAULT NULL COMMENT 'erp_outsourcing uid',
	`item_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '품목코드',
	`standard` VARCHAR(50) NULL DEFAULT NULL COMMENT '규격',
	`cnt` INT(11) NULL DEFAULT NULL COMMENT '발주수량',
	PRIMARY KEY (`uid`),
	INDEX `fid` (`fid`)
)
COMMENT='외주발주 품목'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_position` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`position_nm` VARCHAR(50) NOT NULL COMMENT '직위명',
	`seq` INT(11) NULL DEFAULT '0' COMMENT '출력순서',
	PRIMARY KEY (`uid`)
)
COMMENT='직위'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_process` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT,
	`process_nm` VARCHAR(50) NULL DEFAULT NULL,
	PRIMARY KEY (`uid`)
)
COMMENT='공정'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_project` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`project_nm` VARCHAR(50) NOT NULL COMMENT '프로젝트명',
	`emp_id` VARCHAR(50) NOT NULL COMMENT '담당사원아이디',
	`account_cd` VARCHAR(50) NOT NULL COMMENT '거래처코드',
	`classification` VARCHAR(50) NOT NULL COMMENT '프로젝트구분',
	`start_dt` DATETIME NOT NULL COMMENT '프로젝트시작일',
	`end_dt` DATETIME NOT NULL COMMENT '프로젝트종료일',
	PRIMARY KEY (`uid`),
	INDEX `project_cd` (`project_nm`, `classification`)
)
COMMENT='프로젝트'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_project_attach` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`fid` INT(11) NOT NULL COMMENT '프로젝트코드',
	`attach` VARCHAR(255) NOT NULL COMMENT '첨부파일',
	PRIMARY KEY (`uid`),
	INDEX `project_cd` (`fid`)
)
COMMENT='프로젝트 첨부파일'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_public_thing` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`item_nm` VARCHAR(50) NOT NULL COMMENT '공용품명',
	`classification` VARCHAR(50) NOT NULL COMMENT '공용품구분',
	`in_dt` DATETIME NOT NULL COMMENT '도입일',
	`change_day` INT(11) NOT NULL COMMENT '교환일',
	`change_classification` VARCHAR(50) NOT NULL COMMENT '교환단위',
	`alarm_dt` DATETIME NOT NULL COMMENT '교환알림일자',
	`charge_id` VARCHAR(50) NOT NULL COMMENT '담당자아이디',
	`charge_nm` VARCHAR(50) NOT NULL COMMENT '담당자명',
	`attach` VARCHAR(255) NOT NULL COMMENT '첨부파일',
	`create_dt` DATETIME NOT NULL COMMENT '작성일',
	PRIMARY KEY (`uid`),
	INDEX `item_nm` (`item_nm`, `classification`)
)
COMMENT='공용품관리'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_purchase` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`purchase_cd` VARCHAR(50) NULL DEFAULT '0' COMMENT '구매요청서코드',
	`title` VARCHAR(100) NULL DEFAULT NULL COMMENT '제목',
	`purchase_type` VARCHAR(100) NULL DEFAULT NULL COMMENT '주문유형',
	`order_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '수주서코드',
	`work_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '작업지시서코드',
	`big_department_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '요청부서',
	`middle_department_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '요청부서',
	`small_department_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '요청부서',
	`warehouse_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '입고창고',
	`delivery_dt` DATETIME NULL DEFAULT NULL COMMENT '희망입고일',
	`emp_id` VARCHAR(50) NULL DEFAULT NULL COMMENT '요청부서',
	`state` CHAR(1) NULL DEFAULT NULL COMMENT '입고완료여부',
	`payable` CHAR(1) NULL DEFAULT NULL COMMENT '결재여부',
	`payable_price` INT(11) NULL DEFAULT '0' COMMENT '잔금',
	`payment` INT(11) NULL DEFAULT '0' COMMENT '지급금',
	`create_dt` DATETIME NULL DEFAULT NULL COMMENT '등록일',
	PRIMARY KEY (`uid`)
)
COMMENT='구매발주서'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_purchase_item` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`fid` INT(11) NULL DEFAULT NULL COMMENT 'erp_purchase uid',
	`item_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '품목코드',
	`standard` VARCHAR(50) NULL DEFAULT NULL COMMENT '규격',
	`unit` VARCHAR(50) NULL DEFAULT NULL COMMENT '단위',
	`cnt` INT(11) NULL DEFAULT NULL COMMENT '구매요청수량',
	`purchase_price` INT(11) NULL DEFAULT NULL COMMENT '구매단가',
	`total_price` INT(11) NULL DEFAULT NULL COMMENT '구매합계금액',
	`state` VARCHAR(50) NULL DEFAULT NULL COMMENT '입고상태',
	PRIMARY KEY (`uid`),
	INDEX `fid` (`fid`)
)
COMMENT='구매요청품목'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_qc` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`fid` VARCHAR(50) NULL DEFAULT NULL COMMENT '주문서코드',
	`item_cd` VARCHAR(255) NOT NULL COMMENT '품목코드',
	`item_nm` VARCHAR(255) NOT NULL COMMENT '품목명',
	`standard` VARCHAR(100) NULL DEFAULT NULL COMMENT '규격',
	`order_cnt` INT(11) NOT NULL COMMENT '검사지시수량',
	`state` VARCHAR(50) NOT NULL COMMENT '검사상태',
	`warehouse_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '입고창고',
	`create_dt` DATETIME NOT NULL COMMENT '등록일',
	PRIMARY KEY (`uid`)
)
COMMENT='품질검사대기'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_qc_classify` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`classify_nm` VARCHAR(50) NULL DEFAULT NULL COMMENT '구분명',
	PRIMARY KEY (`uid`)
)
COMMENT='검사구분'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_qc_item` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`qc_classify` INT(11) NULL DEFAULT '0' COMMENT '검사구분값 참조',
	`qc_nm` VARCHAR(50) NULL DEFAULT NULL COMMENT '검사명',
	`field_nm` VARCHAR(50) NULL DEFAULT NULL COMMENT '필드명',
	`qc_type` VARCHAR(50) NULL DEFAULT NULL COMMENT '검사유형',
	`qc_type_txt` VARCHAR(50) NULL DEFAULT NULL COMMENT '검사유형텍스트',
	`txt` VARCHAR(50) NULL DEFAULT NULL COMMENT '설명글',
	PRIMARY KEY (`uid`)
)
COMMENT='검사항목 설정'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_quality` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`quality_nm` VARCHAR(100) NULL DEFAULT NULL COMMENT '재질명',
	PRIMARY KEY (`uid`)
)
COMMENT='재질'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_reason` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`gid` INT(11) NULL DEFAULT '0' COMMENT '품목 참조키',
	`fid` INT(11) NULL DEFAULT NULL COMMENT 'inout 참조키',
	`in_cnt` INT(11) NULL DEFAULT NULL COMMENT '입고수량',
	`out_cnt` INT(11) NULL DEFAULT NULL COMMENT '출고수량',
	`reason` VARCHAR(50) NULL DEFAULT NULL COMMENT '사유',
	`create_dt` DATETIME NULL DEFAULT NULL COMMENT '등록일',
	PRIMARY KEY (`uid`),
	INDEX `fid` (`fid`),
	INDEX `gid` (`gid`)
)
COMMENT='자재입출고사유'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_release` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`release_cd` VARCHAR(50) NULL DEFAULT '0' COMMENT '출고요청서코드',
	`work_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '작업지시서코드',
	`warehouse_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '출고창고코드',
	`release_type` VARCHAR(50) NULL DEFAULT NULL COMMENT '출고요청구분',
	`title` VARCHAR(255) NULL DEFAULT NULL COMMENT '제목',
	`state` VARCHAR(50) NULL DEFAULT NULL COMMENT '출고상태',
	`emp_id` VARCHAR(50) NULL DEFAULT NULL COMMENT '등록자',
	`create_dt` DATETIME NULL DEFAULT NULL COMMENT '등록일',
	PRIMARY KEY (`uid`),
	INDEX `fid` (`work_cd`)
)
COMMENT='출고요청서'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_release_item` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`fid` INT(11) NULL DEFAULT NULL COMMENT 'erp_release uid',
	`item_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '품목코드',
	`standard` VARCHAR(50) NULL DEFAULT NULL COMMENT '규격',
	`cnt` INT(11) NULL DEFAULT NULL COMMENT '출고요청수량',
	`purchase_price` INT(11) NULL DEFAULT NULL COMMENT '구매단가',
	`sale_price` INT(11) NULL DEFAULT NULL COMMENT '출고단가(외주시 입력)',
	PRIMARY KEY (`uid`),
	INDEX `fid` (`fid`)
)
COMMENT='출고요청품목'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_salesplan` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`account_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '거래처코드',
	`emp_id` VARCHAR(50) NULL DEFAULT NULL COMMENT '영업담당자아이디',
	`expectation_dt` DATETIME NULL DEFAULT NULL COMMENT '예상매출월',
	PRIMARY KEY (`uid`),
	INDEX `emp_id` (`emp_id`)
)
COMMENT='매출계획'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_salesplan_item` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`fid` INT(11) NULL DEFAULT NULL COMMENT '생산계획참조키',
	`item_cd` VARCHAR(255) NULL DEFAULT NULL COMMENT '아이템코드',
	`item_nm` VARCHAR(255) NULL DEFAULT NULL COMMENT '아이템명',
	`standard` VARCHAR(100) NULL DEFAULT NULL COMMENT '규격',
	`cnt` INT(11) NULL DEFAULT NULL COMMENT '수량',
	`sale_price` INT(11) NULL DEFAULT NULL COMMENT '판매단가',
	`tariff` FLOAT NULL DEFAULT NULL COMMENT '요율',
	`adjustments` INT(11) NULL DEFAULT NULL COMMENT '조정단가',
	`supply_price` INT(11) NULL DEFAULT NULL COMMENT '공급가액',
	`tax` INT(11) NULL DEFAULT NULL COMMENT '부가세',
	`total_price` INT(11) NULL DEFAULT NULL COMMENT '합계금액',
	PRIMARY KEY (`uid`),
	INDEX `fid` (`fid`)
)
COMMENT='매출계획품목'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_schedule` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`title` VARCHAR(50) NULL DEFAULT NULL COMMENT '제목',
	`anniversary` VARCHAR(50) NULL DEFAULT NULL COMMENT '기념일',
	`classification` VARCHAR(50) NULL DEFAULT NULL COMMENT '일정구분',
	`name` VARCHAR(50) NULL DEFAULT NULL COMMENT '고객명',
	`schedule_dt` VARCHAR(50) NULL DEFAULT NULL COMMENT '일정일',
	`schedule_tm` VARCHAR(50) NULL DEFAULT NULL COMMENT '일정시간',
	`place` VARCHAR(50) NULL DEFAULT NULL COMMENT '약속장소',
	`importance` VARCHAR(50) NULL DEFAULT NULL COMMENT '중요도',
	`memo` TEXT NULL COMMENT '메모',
	`emp_id` VARCHAR(50) NULL DEFAULT NULL COMMENT '등록자',
	PRIMARY KEY (`uid`),
	INDEX `emp_id` (`emp_id`)
)
COMMENT='일정'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_shipment` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`fid` INT(11) NULL DEFAULT NULL COMMENT '수주참조키',
	`order_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '수주코드',
	`account_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '거래처코드',
	`manager` VARCHAR(50) NULL DEFAULT NULL COMMENT '담당자',
	`telephone` VARCHAR(50) NULL DEFAULT NULL COMMENT '연락처',
	`warehouse_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '출하창고코드',
	`delivery_dt` DATETIME NULL DEFAULT NULL COMMENT '출하예정일',
	`zipcode` VARCHAR(50) NULL DEFAULT NULL COMMENT '우편번호',
	`address` VARCHAR(255) NULL DEFAULT NULL COMMENT '주소',
	`state` VARCHAR(255) NULL DEFAULT NULL COMMENT '출하상태',
	`emp_id` VARCHAR(255) NULL DEFAULT NULL COMMENT '지시서작성인',
	`create_dt` VARCHAR(255) NULL DEFAULT NULL COMMENT '지시서작성일',
	PRIMARY KEY (`uid`),
	INDEX `fid` (`fid`)
)
COMMENT='출하지시서'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_shipment_item` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`fid` INT(11) NULL DEFAULT NULL COMMENT 'erp_shipment 참조키',
	`item_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '품목코드',
	`item_nm` VARCHAR(50) NULL DEFAULT NULL COMMENT '품목명',
	`standard` VARCHAR(50) NULL DEFAULT NULL COMMENT '규격',
	`shipment_cnt` INT(11) NULL DEFAULT NULL COMMENT '출하지시수량',
	`state` VARCHAR(50) NULL DEFAULT NULL COMMENT '출하상태',
	PRIMARY KEY (`uid`),
	INDEX `fid` (`fid`)
)
COMMENT='출하품목'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_spending_resolution` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`big_department_cd` INT(11) NULL DEFAULT NULL COMMENT '대부서',
	`middle_department_cd` INT(11) NULL DEFAULT NULL COMMENT '중부서',
	`small_department_cd` INT(11) NULL DEFAULT NULL COMMENT '소부서',
	`emp_id` VARCHAR(50) NULL DEFAULT NULL COMMENT '담당자',
	`draft_dt` DATETIME NULL DEFAULT NULL COMMENT '기안일',
	`title` VARCHAR(50) NULL DEFAULT NULL COMMENT '제목',
	`spending_dt` DATETIME NULL DEFAULT NULL COMMENT '지급요청일',
	`bank` VARCHAR(50) NULL DEFAULT NULL COMMENT '은행',
	`account_number` VARCHAR(50) NULL DEFAULT NULL COMMENT '계좌',
	`account_holder` VARCHAR(50) NULL DEFAULT NULL COMMENT '예금주',
	`total_price` INT(11) NULL DEFAULT NULL COMMENT '합계금액',
	`spending_condition` VARCHAR(50) NULL DEFAULT NULL COMMENT '지급조건',
	PRIMARY KEY (`uid`)
)
COMMENT='지출결의서'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_spending_resolution_attach` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`fid` INT(11) NULL DEFAULT NULL COMMENT 'erp_spending_resolution_data uid',
	`attach` VARCHAR(255) NULL DEFAULT NULL COMMENT '첨부파일',
	PRIMARY KEY (`uid`),
	INDEX `fid` (`fid`)
)
COMMENT='지출결의서항목증빙서류'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_spending_resolution_data` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`fid` INT(11) NOT NULL COMMENT 'erp_spending_resolution uid',
	`title_account` VARCHAR(50) NULL DEFAULT NULL COMMENT '계정과목',
	`expense_dt` DATETIME NULL DEFAULT NULL COMMENT '지출일',
	`expense_memo` VARCHAR(50) NULL DEFAULT NULL COMMENT '지출내용',
	`account` VARCHAR(50) NULL DEFAULT NULL COMMENT '거래처',
	`cost` INT(11) NULL DEFAULT NULL COMMENT '금액',
	`payment` VARCHAR(50) NULL DEFAULT NULL COMMENT '결제수단',
	`memo` VARCHAR(50) NULL DEFAULT NULL COMMENT '비고',
	PRIMARY KEY (`uid`),
	INDEX `fid` (`fid`)
)
COMMENT='지출결의서항목'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_srite` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`srite` VARCHAR(50) NULL DEFAULT NULL COMMENT '스릿트폭',
	PRIMARY KEY (`uid`)
)
COMMENT='제품규격/스릿트폭'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_standard` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`item_cd` VARCHAR(50) NOT NULL COMMENT '품목코드',
	`standard` VARCHAR(100) NOT NULL COMMENT '규격',
	PRIMARY KEY (`uid`),
	INDEX `item_cd` (`item_cd`)
)
COMMENT='규격'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_stock` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`fid` INT(11) NULL DEFAULT NULL COMMENT '품목참조키',
	`document_fid` INT(11) NULL DEFAULT NULL COMMENT '발생된 문서(구매주문, 작업지시서 등)',
	`in_cnt` VARCHAR(255) NULL DEFAULT NULL COMMENT '품목코드',
	`out_cnt` VARCHAR(255) NULL DEFAULT NULL COMMENT '품목명',
	`remain_cnt` INT(11) NULL DEFAULT NULL COMMENT '잔여수량',
	`lot_no` VARCHAR(100) NULL DEFAULT NULL COMMENT '규격',
	`warehouse_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '입고창고코드',
	`used` CHAR(50) NULL DEFAULT NULL COMMENT '사용여부',
	`create_dt` DATETIME NULL DEFAULT NULL COMMENT '입고일',
	PRIMARY KEY (`uid`),
	INDEX `fid` (`fid`)
)
COMMENT='자재'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_warehouse` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`classification` VARCHAR(50) NULL DEFAULT NULL COMMENT '창고구분',
	`warehouse_nm` VARCHAR(50) NULL DEFAULT NULL COMMENT '창고명',
	`account_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '외주창고시거래처코드',
	PRIMARY KEY (`uid`)
)
COMMENT='창고관리'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_withdrawal` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`fid` INT(11) NULL DEFAULT NULL COMMENT 'erp_purchase uid',
	`price` INT(11) NULL DEFAULT NULL COMMENT '지급금액',
	`create_dt` DATETIME NULL DEFAULT NULL COMMENT '지급일',
	PRIMARY KEY (`uid`)
)
COMMENT='구매대금거래내역'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_work` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`classification` VARCHAR(50) NULL DEFAULT NULL COMMENT '외주구분',
	`work_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '작업지시서코드',
	`order_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '수주코드',
	`account_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '거래처코드',
	`item_cd` VARCHAR(255) NULL DEFAULT NULL COMMENT '출하제품코드',
	`standard` VARCHAR(100) NULL DEFAULT NULL COMMENT '출하제품규격',
	`cnt` INT(11) NULL DEFAULT NULL COMMENT '발주수량',
	`delivery_dt` DATETIME NULL DEFAULT NULL COMMENT '납품기한',
	`machine` VARCHAR(50) NULL DEFAULT NULL COMMENT '작업기계',
	`process_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '작업공정코드',
	`process_item_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '공정생산품코드',
	`process_standard` VARCHAR(50) NULL DEFAULT NULL COMMENT '공정생산품규격',
	`process_cnt` INT(11) NULL DEFAULT NULL COMMENT '공정생산품필요수량',
	`create_dt` DATETIME NULL DEFAULT NULL COMMENT '작업지시일',
	`work_start_dt` DATETIME NULL DEFAULT NULL COMMENT '작업예정시작일',
	`work_end_dt` DATETIME NULL DEFAULT NULL COMMENT '작업예정종료일',
	`work_start_time` DATETIME NULL DEFAULT NULL COMMENT '작업시작시간',
	`work_end_time` DATETIME NULL DEFAULT NULL COMMENT '작업종료시간',
	`seq` INT(11) NULL DEFAULT NULL COMMENT '작업순서',
	`state` VARCHAR(50) NULL DEFAULT NULL COMMENT '상태',
	PRIMARY KEY (`uid`)
)
COMMENT='작업지시서'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_workplan` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`order_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '주문서코드',
	`title` VARCHAR(255) NULL DEFAULT NULL COMMENT '적요',
	`work_gb` VARCHAR(50) NOT NULL COMMENT '생산유형',
	`workplan_cd` VARCHAR(50) NOT NULL COMMENT '생산계획코드',
	`start_dt` DATETIME NOT NULL COMMENT '시작일',
	`end_dt` DATETIME NOT NULL COMMENT '종료일',
	`used` CHAR(50) NOT NULL COMMENT '생산계획사용여부',
	`create_dt` DATETIME NOT NULL COMMENT '등록일',
	PRIMARY KEY (`uid`),
	INDEX `workplan_cd` (`workplan_cd`, `start_dt`, `end_dt`),
	INDEX `order_cd` (`order_cd`)
)
COMMENT='생산계획'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_workplan_item` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`workplan_cd` VARCHAR(50) NOT NULL COMMENT '생산계획참조키',
	`item_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '품목코드',
	`item_nm` VARCHAR(50) NULL DEFAULT NULL COMMENT '품목명',
	`standard` VARCHAR(50) NULL DEFAULT NULL COMMENT '규격',
	`cnt` INT(11) NULL DEFAULT NULL COMMENT '생산수량',
	`make_cnt` INT(11) NULL DEFAULT NULL COMMENT '생산된수량',
	`work_start_dt` DATETIME NULL DEFAULT NULL COMMENT '작업시작일',
	`work_end_dt` DATETIME NULL DEFAULT NULL COMMENT '작업종료일',
	`order_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '수주(주문)코드',
	PRIMARY KEY (`uid`),
	INDEX `workplan_cd` (`workplan_cd`, `work_start_dt`, `work_end_dt`, `order_cd`)
)
COMMENT='생산계획 품목'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_work_item` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT,
	`order_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '수주코드',
	`process` VARCHAR(50) NULL DEFAULT NULL COMMENT '공정코드',
	`machine` INT(11) NULL DEFAULT NULL COMMENT '작업기계',
	`item_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '수주받은품목코드',
	`item_nm` VARCHAR(50) NULL DEFAULT NULL COMMENT '수주받은품목명',
	`standard` VARCHAR(50) NULL DEFAULT NULL COMMENT '수주받은품목규격',
	`work_item_nm` VARCHAR(50) NULL DEFAULT NULL COMMENT '생산해야할품목',
	`work_item_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '생산해야할품목코드',
	`work_item_standard` VARCHAR(50) NULL DEFAULT NULL COMMENT '생산규격',
	`work_unit` VARCHAR(50) NULL DEFAULT NULL COMMENT '생산단위',
	`work_cnt` INT(11) NULL DEFAULT NULL COMMENT '지시수량',
	`make_cnt` INT(11) NULL DEFAULT NULL COMMENT '만든수량',
	`remain_cnt` INT(11) UNSIGNED NULL DEFAULT NULL COMMENT '잔여수량',
	`seq` INT(11) NULL DEFAULT NULL COMMENT '작업순서',
	`work_dt` DATETIME NOT NULL COMMENT '작업일',
	PRIMARY KEY (`uid`),
	INDEX `work_cd` (`process`, `machine`),
	INDEX `order_cd` (`order_cd`)
)
COMMENT='작업시 투입된 자재 등록'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_work_leave` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`emp_id` VARCHAR(50) NOT NULL COMMENT '사원아이디',
	`emp_nm` VARCHAR(50) NOT NULL COMMENT '사원명',
	`work_tm` VARCHAR(50) NULL DEFAULT NULL COMMENT '출근시간',
	`leave_tm` VARCHAR(50) NULL DEFAULT NULL COMMENT '퇴근시간',
	`create_dt` DATETIME NOT NULL COMMENT '출근일',
	PRIMARY KEY (`uid`),
	INDEX `emp_id` (`emp_id`)
)
COMMENT='출퇴근기록'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_work_put_item` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`fid` INT(11) NULL DEFAULT NULL COMMENT '작업지시서참조',
	`put_item_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '투입품목코드',
	`put_item_nm` VARCHAR(50) NULL DEFAULT NULL COMMENT '투입품목명',
	`put_item_standard` VARCHAR(50) NULL DEFAULT NULL COMMENT '투입품목규격',
	`bom_cnt` INT(11) NULL DEFAULT NULL COMMENT 'BOM상의 투입량',
	`used_cnt` INT(11) NULL DEFAULT NULL COMMENT '실투입량',
	`lot_no` VARCHAR(50) NULL DEFAULT NULL COMMENT 'lot_no',
	`put_dt` DATETIME NULL DEFAULT NULL COMMENT '투입일',
	PRIMARY KEY (`uid`),
	INDEX `fid` (`fid`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";

$sql[] = "
CREATE TABLE `erp_work_report` (
	`uid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '유니크아이디',
	`fid` INT(11) NOT NULL DEFAULT '0' COMMENT '작업지시서참고코드',
	`order_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '수주코드',
	`order_item_cd` VARCHAR(255) NULL DEFAULT NULL COMMENT '수주품목코드',
	`order_item_standard` VARCHAR(100) NULL DEFAULT NULL COMMENT '수주품목규격',
	`work_dt` DATETIME NULL DEFAULT NULL COMMENT '작업일',
	`emp_id` VARCHAR(50) NULL DEFAULT NULL COMMENT '등록자아이디',
	`work_item_cd` VARCHAR(255) NULL DEFAULT NULL COMMENT '작업품목코드',
	`work_item_standard` VARCHAR(100) NULL DEFAULT NULL COMMENT '작업품목규격',
	`order_cnt` INT(11) NULL DEFAULT NULL COMMENT '생산지시수량',
	`process_cd` VARCHAR(50) NULL DEFAULT NULL COMMENT '공정코드',
	`machine` VARCHAR(50) NULL DEFAULT NULL COMMENT '기계명',
	`work_cnt` INT(11) NULL DEFAULT NULL COMMENT '적격생산량',
	`defective_cnt` INT(11) NULL DEFAULT NULL COMMENT '불량생산량',
	`work_start_time` DATETIME NULL DEFAULT NULL COMMENT '작업시작시간',
	`work_end_time` DATETIME NULL DEFAULT NULL COMMENT '작업종료시간',
	PRIMARY KEY (`uid`)
)
COMMENT='생산실적'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
";
?>