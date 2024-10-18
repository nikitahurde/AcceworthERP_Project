
<?php 


/*----- strat : dispacth table in ace_cfms db--------*/

	SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
	SET AUTOCOMMIT = 0;
	START TRANSACTION;
	SET time_zone = "+00:00";
	
	CREATE TABLE `despatch` (
	  `id` int(11) NOT NULL,
	  `depot` varchar(60) NOT NULL,
	  `date` date NOT NULL,
	  `challan_no` int(60) NOT NULL,
	  `party` varchar(60) NOT NULL,
	  `destination` varchar(60) NOT NULL,
	  `transporter` varchar(60) NOT NULL,
	  `vehicle_no` varchar(120) NOT NULL,
	  `qty_mt` varchar(60) NOT NULL,
	  `qty_bag` int(11) NOT NULL,
	  `flag` varchar(60) NOT NULL,
	  `item` varchar(50) NOT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;


/*----- end : dispacth table in ace_cfms db--------*/

/*----- strat : fleet_trans table in ace_cfms db--------*/

	CREATE TABLE `fleet_trans` (
	  `id` int(11) NOT NULL,
	  `TR_DATE` date NOT NULL,
	  `DEPOT_CODE` varchar(10) NOT NULL,
	  `LR_NO` varchar(20) NOT NULL,
	  `INVOICE_NO` varchar(50) NOT NULL,
	  `ACC_CODE` varchar(30) NOT NULL,
	  `AREA_CODE` varchar(10) NOT NULL,
	  `TRPT_CODE` varchar(20) NOT NULL,
	  `TRUCK_NO` varchar(30) NOT NULL,
	  `UM` varchar(40) NOT NULL,
	  `ITEM_CODE` varchar(30) NOT NULL,
	  `DRIVER_EXP` int(30) NOT NULL,
	  `FOODING_EXP` int(30) NOT NULL,
	  `ADMIN_EXP` int(30) NOT NULL,
	  `ULOADING_EXP` int(30) NOT NULL,
	  `TOLL_EXP` int(30) NOT NULL,
	  `DIESEL_EXP` int(30) NOT NULL,
	  `DIESEL_QTY` int(30) NOT NULL,
	  `DIESEL_SLIP_NO` int(30) NOT NULL,
	  `LR_REC_DATE` date NOT NULL,
	  `DAMAGE_QTY` varchar(20) NOT NULL,
	  `SHORTAGE_QTY` varchar(20) NOT NULL,
	  `STAMP` tinyint(1) NOT NULL,
	  `BILL_NO` varchar(20) NOT NULL,
	  `BILL_DATE` date NOT NULL,
	  `OVERLOAD` enum('Y','N') DEFAULT NULL,
	  `RATE` varchar(100) NOT NULL,
	  `created_by` varchar(20) DEFAULT NULL,
	  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	  `last_updat_by` varchar(20) DEFAULT NULL,
	  `last_updat_date` date DEFAULT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;

	/*----- end : fleet_trans table in ace_cfms db--------*/

	/*----- strat : fleet_truck_wheel table in ace_cfms db--------*/

	CREATE TABLE `fleet_truck_wheel` (
	  `id` int(11) NOT NULL,
	  `wheel_code` varchar(20) NOT NULL,
	  `wheel_name` varchar(40) NOT NULL,
	  `status` enum('Y','N') NOT NULL DEFAULT 'Y'
	) ENGINE=MyISAM DEFAULT CHARSET=latin1;

	/*----- end : fleet_truck_wheel table in ace_cfms db--------*/

	/*----- strat : form_name table in ace_cfms db--------*/

	CREATE TABLE `form_name` (
	  `id` int(11) NOT NULL,
	  `form_name` varchar(152) NOT NULL,
	  `form_number` varchar(100) NOT NULL,
	  `updated_at` date NOT NULL,
	  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

	/*----- end : form_name table in ace_cfms db--------*/

	/*----- strat : inward_trans table in ace_cfms db--------*/

	CREATE TABLE `inward_trans` (
	  `id` int(11) NOT NULL,
	  `comp_code` varchar(25) DEFAULT NULL,
	  `fy_year` varchar(12) DEFAULT NULL,
	  `depot_code` varchar(12) DEFAULT NULL,
	  `vr_date` date DEFAULT NULL,
	  `vr_no` varchar(14) DEFAULT NULL,
	  `invoice_no` varchar(14) DEFAULT NULL,
	  `invoice_date` date DEFAULT NULL,
	  `acc_code` varchar(40) DEFAULT NULL,
	  `trpt_code` varchar(14) DEFAULT NULL,
	  `truck_no` varchar(14) DEFAULT NULL,
	  `item_code` varchar(15) DEFAULT NULL,
	  `sto_qty` int(15) DEFAULT NULL,
	  `sto_um` varchar(15) DEFAULT NULL,
	  `sto_aqty` int(15) DEFAULT NULL,
	  `sto_aum` varchar(15) DEFAULT NULL,
	  `qty_recd` int(15) DEFAULT NULL,
	  `aqty_recd` varchar(15) DEFAULT NULL,
	  `short_qty` int(15) DEFAULT NULL,
	  `short_aqty` int(15) DEFAULT NULL,
	  `damage_qty` int(15) DEFAULT NULL,
	  `damage_aqty` int(15) DEFAULT NULL,
	  `return_qty` int(40) NOT NULL,
	  `flag` varchar(10) NOT NULL,
	  `created_by` varchar(12) DEFAULT NULL,
	  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	  `last_updat_by` varchar(12) DEFAULT NULL,
	  `last_updat_date` date NOT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;

	/*----- end : inward_trans table in ace_cfms db--------*/

	/*----- strat : master_acc table in ace_cfms db--------*/

	CREATE TABLE `master_acc` (
	  `id` int(11) NOT NULL,
	  `acc_code` varchar(12) DEFAULT NULL,
	  `acc_name` varchar(40) DEFAULT NULL,
	  `acctype_code` varchar(20) DEFAULT NULL,
	  `add1` varchar(40) DEFAULT NULL,
	  `add2` varchar(40) DEFAULT NULL,
	  `add3` varchar(40) DEFAULT NULL,
	  `country` varchar(20) DEFAULT NULL,
	  `state_code` varchar(6) DEFAULT NULL,
	  `district` varchar(20) NOT NULL,
	  `city` varchar(20) NOT NULL,
	  `pincode` int(6) DEFAULT NULL,
	  `created_by` varchar(12) DEFAULT NULL,
	  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	  `last_updat_by` varchar(12) DEFAULT NULL,
	  `last_updat_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	  `flag` int(11) NOT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;

	/*----- end : master_acc table in ace_cfms db--------*/

	/*----- strat : master_acctype table in ace_cfms db--------*/

	CREATE TABLE `master_acctype` (
	  `id` int(11) NOT NULL,
	  `acctype_code` varchar(20) DEFAULT NULL,
	  `acctype_name` varchar(40) DEFAULT NULL,
	  `created_by` varchar(12) DEFAULT NULL,
	  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	  `last_updat_by` varchar(12) DEFAULT NULL,
	  `last_updat_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;

	/*----- end : master_acctype table in ace_cfms db--------*/

	/*----- strat : master_area table in ace_cfms db--------*/

	CREATE TABLE `master_area` (
	  `id` int(11) NOT NULL,
	  `name` varchar(200) NOT NULL,
	  `code` varchar(200) NOT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;

	/*----- end : master_area table in ace_cfms db--------*/

	/*----- strat : master_comp table in ace_cfms db--------*/

	CREATE TABLE `master_comp` (
	  `id` int(11) NOT NULL,
	  `comp_code` varchar(20) DEFAULT NULL,
	  `comp_name` varchar(40) DEFAULT NULL,
	  `add1` varchar(40) DEFAULT NULL,
	  `add2` varchar(40) DEFAULT NULL,
	  `add3` varchar(40) DEFAULT NULL,
	  `country` varchar(20) DEFAULT NULL,
	  `state` varchar(30) DEFAULT NULL,
	  `district` varchar(30) DEFAULT NULL,
	  `city` varchar(30) DEFAULT NULL,
	  `pin_code` varchar(6) DEFAULT NULL,
	  `phone1` varchar(20) DEFAULT NULL,
	  `phone2` varchar(20) DEFAULT NULL,
	  `fax_no` varchar(20) DEFAULT NULL,
	  `email_id` varchar(100) DEFAULT NULL,
	  `created_by` varchar(10) DEFAULT NULL,
	  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
	  `last_updat_by` varchar(10) DEFAULT NULL,
	  `last_updat_date` date DEFAULT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;

	/*----- end : master_comp table in ace_cfms db--------*/

	/*----- strat : master_dealer table in ace_cfms db--------*/

	CREATE TABLE `master_dealer` (
	  `id` int(11) NOT NULL,
	  `code` varchar(26) NOT NULL,
	  `name` varchar(230) NOT NULL,
	  `address` varchar(230) NOT NULL,
	  `contact_person` varchar(230) NOT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;

	/*----- end : master_dealer table in ace_cfms db--------*/

	/*----- strat : master_depot table in ace_cfms db--------*/

	CREATE TABLE `master_depot` (
	  `id` int(11) NOT NULL,
	  `depot_code` varchar(12) DEFAULT NULL,
	  `depot_name` varchar(40) DEFAULT NULL,
	  `add1` varchar(40) DEFAULT NULL,
	  `add2` varchar(40) DEFAULT NULL,
	  `add3` varchar(40) DEFAULT NULL,
	  `country` varchar(30) DEFAULT NULL,
	  `state_code` varchar(20) DEFAULT NULL,
	  `district` varchar(30) NOT NULL,
	  `city` varchar(30) NOT NULL,
	  `pincode` varchar(6) DEFAULT NULL,
	  `contac_person` varchar(20) DEFAULT NULL,
	  `contac_email` varchar(40) DEFAULT NULL,
	  `created_by` varchar(12) DEFAULT NULL,
	  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	  `last_updat_by` varchar(12) DEFAULT NULL,
	  `last_updat_date` date DEFAULT NULL,
	  `flag` int(12) DEFAULT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;

	/*----- end : master_depot table in ace_cfms db--------*/

	/*----- strat : master_fleet table in ace_cfms db--------*/

	CREATE TABLE `master_fleet` (
	  `id` int(11) NOT NULL,
	  `truck_no` varchar(50) NOT NULL,
	  `regd_date` date NOT NULL,
	  `make_model` varchar(40) NOT NULL,
	  `location` varchar(40) NOT NULL,
	  `wheels_type` varchar(40) NOT NULL,
	  `load_capacity` varchar(10) NOT NULL,
	  `created_by` int(11) DEFAULT NULL,
	  `created_date` timestamp NULL DEFAULT NULL,
	  `last_update_by` int(11) DEFAULT NULL,
	  `last_updated_date` date DEFAULT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;


	/*----- end : master_fleet table in ace_cfms db--------*/

	/*----- strat : master_form table in ace_cfms db--------*/

	CREATE TABLE `master_form` (
	  `id` int(11) NOT NULL,
	  `user_id` int(100) NOT NULL,
	  `form_name_id` int(100) NOT NULL,
	  `updated_at` date DEFAULT NULL,
	  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

	/*----- end : master_form table in ace_cfms db--------*/

    /*----- strat : master_fy table in ace_cfms db--------*/

	CREATE TABLE `master_fy` (
	  `id` int(11) NOT NULL,
	  `comp_code` varchar(20) DEFAULT NULL,
	  `fy_code` varchar(10) DEFAULT NULL,
	  `fy_from_date` varchar(14) DEFAULT NULL,
	  `fy_to_date` varchar(14) DEFAULT NULL,
	  `created_by` varchar(20) DEFAULT NULL,
	  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	  `last_updat_by` varchar(20) DEFAULT NULL,
	  `last_updat_date` date DEFAULT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;

	/*----- end : master_fy table in ace_cfms db--------*/

	/*----- strat : master_item table in ace_cfms db--------*/

	CREATE TABLE `master_item` (
	  `id` int(11) NOT NULL,
	  `item_code` varchar(12) DEFAULT NULL,
	  `item_name` varchar(40) DEFAULT NULL,
	  `um` varchar(3) DEFAULT NULL,
	  `aum` varchar(40) DEFAULT NULL,
	  `created_by` varchar(12) DEFAULT NULL,
	  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
	  `last_updat_by` varchar(12) DEFAULT NULL,
	  `last_updat_date` timestamp NULL DEFAULT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;

	/*----- end : master_item table in ace_cfms db--------*/

	/*----- strat : master_itemum table in ace_cfms db--------*/

	CREATE TABLE `master_itemum` (
	  `id` int(11) NOT NULL,
	  `item_code` varchar(40) NOT NULL,
	  `um_code` varchar(40) NOT NULL,
	  `aum` varchar(40) NOT NULL,
	  `aum_factor` double NOT NULL,
	  `created_by` varchar(40) DEFAULT NULL,
	  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
	  `updated_by` varchar(40) DEFAULT NULL,
	  `updated_date` timestamp NULL DEFAULT NULL,
	  `flag` varchar(40) DEFAULT NULL,
	  `itemum_block` varchar(40) DEFAULT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;

	/*----- end : master_itemum table in ace_cfms db--------*/

	/*----- strat : master_rate table in ace_cfms db--------*/

	CREATE TABLE `master_rate` (
	  `id` int(11) NOT NULL,
	  `depot_plant` varchar(250) DEFAULT NULL,
	  `area_code` varchar(20) DEFAULT NULL,
	  `from_date` date DEFAULT NULL,
	  `to_date` date DEFAULT NULL,
	  `rate` int(12) DEFAULT NULL,
	  `wheel_type` varchar(20) DEFAULT NULL,
	  `overload` tinyint(1) DEFAULT NULL,
	  `created_by` varchar(20) NOT NULL,
	  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	  `last_updat_by` varchar(20) DEFAULT NULL,
	  `last_updat_date` date DEFAULT NULL
	) ENGINE=MyISAM DEFAULT CHARSET=latin1;

	/*----- end : master_rate table in ace_cfms db--------*/

	/*----- strat : master_so table in ace_cfms db--------*/

	CREATE TABLE `master_so` (
	  `id` int(11) NOT NULL,
	  `so_code` varchar(150) NOT NULL,
	  `name` varchar(150) NOT NULL,
	  `address` varchar(150) NOT NULL,
	  `contact_no` varchar(150) NOT NULL,
	  `email_id` varchar(150) NOT NULL
	) ENGINE=MyISAM DEFAULT CHARSET=latin1;

	/*----- end : master_so table in ace_cfms db--------*/

	/*----- strat : master_state table in ace_cfms db--------*/

	CREATE TABLE `master_state` (
		  `id` int(11) NOT NULL,
		  `state_code` varchar(2) NOT NULL,
		  `state_name` varchar(40) NOT NULL,
		  `created_by` int(11) NOT NULL,
		  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		  `changed_by` int(11) NOT NULL,
		  `flag` char(1) NOT NULL,
		  `state_block` int(1) NOT NULL DEFAULT '0'
		) ENGINE=InnoDB DEFAULT CHARSET=latin1;

	/*----- end : master_state table in ace_cfms db--------*/

	/*----- strat : master_transporter table in ace_cfms db--------*/

	CREATE TABLE `master_transporter` (
	  `id` int(11) NOT NULL,
	  `code` int(20) NOT NULL,
	  `name` varchar(200) NOT NULL,
	  `address` varchar(230) NOT NULL,
	  `contact_no` varchar(12) NOT NULL,
	  `contact_person` varchar(60) NOT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;

	/*----- end : master_transporter table in ace_cfms db--------*/

	/*----- strat : master_um table in ace_cfms db--------*/

	CREATE TABLE `master_um` (
	  `id` int(11) NOT NULL,
	  `um_code` varchar(40) NOT NULL,
	  `um_name` varchar(40) NOT NULL,
	  `created_by` varchar(40) DEFAULT NULL,
	  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
	  `updated_by` varchar(40) DEFAULT NULL,
	  `updated_date` datetime DEFAULT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;

	/*----- end : master_um table in ace_cfms db--------*/

  /*----- strat : master_user table in ace_cfms db--------*/

	CREATE TABLE `master_user` (
		  `id` int(11) NOT NULL,
		  `name` varchar(150) DEFAULT NULL,
		  `username` varchar(150) DEFAULT NULL,
		  `usercode` varchar(20) DEFAULT NULL,
		  `password` varchar(150) NOT NULL,
		  `confirm_password` varchar(40) NOT NULL,
		  `email_id` varchar(50) NOT NULL,
		  `zone_id` char(3) DEFAULT NULL,
		  `user_type` varchar(20) DEFAULT NULL,
		  `status` enum('Y','N') NOT NULL DEFAULT 'N',
		  `access` text COMMENT 'Module file  name',
		  `cosumer_access` varchar(150) DEFAULT NULL,
		  `created_by` varchar(12) DEFAULT NULL,
		  `created_date` timestamp NULL DEFAULT NULL,
		  `last_update_by` varchar(12) DEFAULT NULL,
		  `last_updated_date` date DEFAULT NULL
		) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*----- end : master_user table in ace_cfms db--------*/

/*----- strat : outward_trans table in ace_cfms db--------*/

	CREATE TABLE `outward_trans` (
	  `id` int(11) NOT NULL,
	  `comp_code` varchar(25) DEFAULT NULL,
	  `fy_year` varchar(10) DEFAULT NULL,
	  `depot_code` varchar(20) DEFAULT NULL,
	  `tr_date` date DEFAULT NULL,
	  `tr_no` varchar(40) DEFAULT NULL,
	  `chalan_no` varchar(40) DEFAULT NULL,
	  `acc_code` varchar(40) DEFAULT NULL,
	  `area_code` varchar(40) DEFAULT NULL,
	  `trans_code` varchar(40) DEFAULT NULL,
	  `truck_no` varchar(40) DEFAULT NULL,
	  `item_code` varchar(20) NOT NULL,
	  `desp_qty` varchar(40) DEFAULT NULL,
	  `desp_aqty` varchar(40) DEFAULT NULL,
	  `inv_no` varchar(40) DEFAULT NULL,
	  `desp_type` varchar(40) DEFAULT NULL,
	  `quantity` varchar(40) DEFAULT NULL,
	  `created_by` varchar(12) DEFAULT NULL,
	  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
	  `last_updat_by` varchar(12) DEFAULT NULL,
	  `last_updat_date` date DEFAULT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*----- end : outward_trans table in ace_cfms db--------*/

/*----- strat : party_bill table in ace_cfms db--------*/

	CREATE TABLE `party_bill` (
	  `id` int(11) NOT NULL,
	  `tr_id` int(11) NOT NULL,
	  `date` varchar(50) NOT NULL,
	  `L_R_NO` varchar(150) NOT NULL,
	  `DEPOT_PLANT` varchar(150) NOT NULL,
	  `INVOICE_NO` varchar(50) NOT NULL,
	  `party` varchar(50) NOT NULL,
	  `DESTINATION` varchar(50) NOT NULL,
	  `Transporter` varchar(50) NOT NULL,
	  `TRUCK_NO` varchar(50) NOT NULL,
	  `QTY` varchar(50) NOT NULL,
	  `MATERIAL` varchar(50) NOT NULL,
	  `DEISEL` varchar(50) NOT NULL,
	  `DRV_Exp` varchar(50) NOT NULL,
	  `P_Exp` varchar(60) NOT NULL,
	  `Fooding` varchar(50) NOT NULL,
	  `LU_Exp` varchar(60) NOT NULL,
	  `toll` varchar(60) NOT NULL,
	  `Other_Exp` varchar(60) NOT NULL,
	  `TOTAL_Adv` varchar(60) NOT NULL,
	  `lr_recieved_date` date NOT NULL,
	  `damage` varchar(60) NOT NULL,
	  `shortage` varchar(60) NOT NULL,
	  `stamp` varchar(60) NOT NULL,
	  `bill_no` varchar(60) NOT NULL,
	  `bill_date` datetime NOT NULL,
	  `rate` varchar(60) NOT NULL
	) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*----- end : party_bill table in ace_cfms db--------*/

/*----- strat : sap_bil table in ace_cfms db--------*/

	CREATE TABLE `sap_bil` (
	  `id` int(11) NOT NULL,
	  `comp_code` varchar(25) DEFAULT NULL,
	  `fy_year` varchar(10) DEFAULT NULL,
	  `depot_code` varchar(40) DEFAULT NULL,
	  `vr_date` date DEFAULT NULL,
	  `vr_no` varchar(40) DEFAULT NULL,
	  `invoice_no` varchar(40) DEFAULT NULL,
	  `invoice_date` date DEFAULT NULL,
	  `acct_code` varchar(40) DEFAULT NULL,
	  `area_code` varchar(40) DEFAULT NULL,
	  `trpt_code` varchar(40) DEFAULT NULL,
	  `truck_no` varchar(40) DEFAULT NULL,
	  `qty_issued` varchar(40) DEFAULT NULL,
	  `um` varchar(40) DEFAULT NULL,
	  `aqty_issued` varchar(40) DEFAULT NULL,
	  `aum` varchar(40) DEFAULT NULL,
	  `item_code` varchar(40) DEFAULT NULL,
	  `so_code` varchar(40) DEFAULT NULL,
	  `created_by` varchar(20) DEFAULT NULL,
	  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	  `last_updat_by` varchar(20) DEFAULT NULL,
	  `last_updat_date` date DEFAULT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;

 /*----- end : sap_bil table in ace_cfms db--------*/

 /*----- strat : sap_bill_tran table in ace_cfms db--------*/

	CREATE TABLE `sap_bill_tran` (
	  `id` int(11) NOT NULL,
	  `depot_code` varchar(40) NOT NULL,
	  `invoice_no` int(50) NOT NULL,
	  `invoice_date` date NOT NULL,
	  `acc_code` varchar(20) NOT NULL,
	  `area_code` varchar(20) NOT NULL,
	  `trpt_code` varchar(20) NOT NULL,
	  `truck_no` varchar(50) NOT NULL,
	  `bill_qty` varchar(20) NOT NULL,
	  `bill_aqty` varchar(20) NOT NULL,
	  `item_code` varchar(50) NOT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*----- end : sap_bill_tran table in ace_cfms db--------*/
 ?>