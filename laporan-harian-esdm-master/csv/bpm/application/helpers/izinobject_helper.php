<?php (! defined('BASEPATH')) and exit('No direct script access allowed');

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Carbon\CarbonInterval;
use Cmixin\BusinessDay;

abstract class PerizinanStatus {
    const ON_TRACK = 0;
    const AT_RISK = 1;
    const OVERDUE = 2;
}

class BaseAccessor {
    // public static $ci;

    public function __construct() {
        // BaseAccessor::$ci = &get_instance();
    }

    public static function &get_ci() {
        return get_instance();
    }

    protected function get_business_day($date, $return_start_of_day = TRUE) {
        $carbon_date = Carbon::parse($date);
        $is_business_day = $carbon_date->isBusinessDay();

        if(!$is_business_day) {
            if($return_start_of_day) {
                // $carbon_date = $carbon_date->subDay(1)->endOfDay();
                $carbon_date = $carbon_date->currentOrNextBusinessDay()->startOfDay();
            } else {
                // $carbon_date = $carbon_date->addDay(1)->startOfDay();
                $carbon_date = $carbon_date->currentOrPreviousBusinessDay()->endOfDay();
            }
        }

        return $carbon_date->format("Y-m-d H:i:s");
    }

    protected function get_interval_string($interval) {
        $interval_string = array();

        $this->interval_component_string($interval_string, $interval->y, "tahun");
        $this->interval_component_string($interval_string, $interval->m, "bulan");
        $this->interval_component_string($interval_string, $interval->d, "hari");
        $this->interval_component_string($interval_string, $interval->h, "jam");
        $this->interval_component_string($interval_string, $interval->i, "menit");
        $this->interval_component_string($interval_string, $interval->s, "detik");

        if(empty($interval_string)) {
            array_push($interval_string, "Tidak terhitung hari kerja");
        }
        
        return implode(" ", $interval_string);
    }
    
    private function interval_component_string(&$interval_string, $component, $component_string) {
        if($component !== 0) {
            $format = "%d %s";
            $component_result = sprintf($format, $component, $component_string);

            array_push($interval_string, $component_result); // Yeee
        }
    }
}

class IzinOngoingAll extends BaseAccessor {
    public $list_izin = array(); // Must be of type IzinDetail
    public $permohonan_count = 0;
    public $on_track_count = 0;
    public $at_risk_count = 0;
    public $late_count = 0;

    public function __construct() {
        parent::__construct();
        BaseAccessor::get_ci()->load->model("M_izin_instansi");

        $this->fill_list_izin();
    }

    public function get_by_id_form($id_form) {
        $key = array_search($id_form, array_map(
            function($item) {
                return $item->data_izin->ID_FORM;
            }, $this->list_izin)
        );

        if($key === FALSE) {
            return FALSE;
        } else {
            return $this->list_izin[$key];
        }
    }

    private function fill_list_izin() {
        $list_izin_raw = BaseAccessor::get_ci()->M_izin_instansi->select_all();

        foreach($list_izin_raw as $izin) {
            $izin_detail = new IzinDetail($izin->ID_FORM);
            array_push($this->list_izin, $izin_detail);
        }

        $this->count_permohonan();
        $this->count_on_track();
        $this->count_at_risk();
        $this->count_late();
    }

    private function count_on_track() {
        $this->on_track_count = array_sum(array_map(
            function($item) {
                return $item->on_track_count;
            }, $this->list_izin)
        );
    }

    private function count_at_risk() {
        $this->at_risk_count = array_sum(array_map(
            function($item) {
                return $item->at_risk_count;
            }, $this->list_izin)
        );
    }

    private function count_permohonan() {
        $this->permohonan_count = array_sum(array_map(
            function($item) {
                return $item->permohonan_count;
            }, $this->list_izin)
        );
    }

    private function count_late() {
        $this->late_count = $this->permohonan_count - $this->on_track_count - $this->at_risk_count;
    }
}

class IzinDetail extends BaseAccessor {
    public $list_template = array(); // Must be type of TemplateDetail

    public $data_izin;
    public $sla_izin;
    public $permohonan_count = 0;
    public $on_track_count = 0;
    public $at_risk_count = 0;
    public $late_count = 0;

    public function __construct($id_form) {
        parent::__construct();
        BaseAccessor::get_ci()->load->model("M_izin_instansi");

        $this->data_izin = BaseAccessor::get_ci()->M_izin_instansi->select_by_id($id_form);
        $this->fill_list_template();
    }

    public function get_by_id_template($id_template) {
        $key = array_search($id_template, array_map(
            function($item) {
                return $item->data_template->ID_TEMPLATE;
            }, $this->list_template)
        );

        if($key === FALSE) {
            return FALSE;
        } else {
            return $this->list_template[$key];
        }
    }

    private function fill_list_template() {
        $list_template_raw = BaseAccessor::get_ci()->M_izin_instansi->select_list_template($this->data_izin->ID_FORM);

        // var_dump($list_template_raw);

        foreach($list_template_raw as $template) {
            $template_detail = new TemplateDetail($template->ID_TEMPLATE);
            array_push($this->list_template, $template_detail);
        }

        $this->count_permohonan();
        $this->count_on_track();
        $this->count_at_risk();
        $this->count_late();
    }

    private function count_on_track() {
        $this->on_track_count = array_sum(array_map(
            function($item) {
                return $item->on_track_count;
            }, $this->list_template)
        );
    }

    private function count_at_risk() {
        $this->at_risk_count = array_sum(array_map(
            function($item) {
                return $item->at_risk_count;
            }, $this->list_template)
        );
    }

    private function count_permohonan() {
        $this->permohonan_count = array_sum(array_map(
            function($item) {
                return $item->permohonan_count;
            }, $this->list_template)
        );
    }

    private function count_late() {
        $this->late_count = $this->permohonan_count - $this->on_track_count - $this->at_risk_count;
    }
}

class TemplateDetail extends BaseAccessor {
    public $list_proses = array(); // Must be type ProsesDetail
    
    public $data_template;
    public $sla_izin = 0;
    public $permohonan_count = 0;
    public $on_track_count = 0;
    public $at_risk_count = 0;
    public $late_count = 0;
    private $proses_group_by_urutan = array();
    private $permohonan_set = array();

    public function __construct($id_template) {
        parent::__construct();
        BaseAccessor::get_ci()->load->model("M_izin_instansi");
        
        $this->data_template = BaseAccessor::get_ci()->M_izin_instansi->select_template($id_template);
        // vdd($this->data_template);
        // return;
        $this->sla_izin = BaseAccessor::get_ci()->M_sla_proses_izin->getIzinTotalSla($this->data_template->ID_FORM);
        $this->fill_list_process();
    }

    public function get_by_id_proses($id_proses) {
        $key = array_search($id_proses, array_map(
            function($item) {
                return $item->data_proses->ID_PROSES;
            }, $this->list_proses)
        );

        if($key === FALSE) {
            return FALSE;
        } else {
            return $this->list_proses[$key];
        }
    }
    
    private function fill_list_process() {
        $list_proses_raw = BaseAccessor::get_ci()->M_proses_skema->select_list_process_by_id_form($this->data_template->ID_FORM);

        foreach($list_proses_raw as $proses) {
            $proses_detail = new ProsesDetail($proses->ID_PROSES, $this);
            array_push($this->list_proses, $proses_detail);
        }

        $this->group_proses_by_urutan();
        $this->count_permohonan();
        $this->count_on_track();
        $this->count_at_risk();
        $this->count_late();
    }

    private function group_proses_by_urutan() {
        // $proses_group_by_urutan = array();

        foreach($this->list_proses as $proses) {
            $urutan = $proses->data_proses->URUTAN;

            $this->proses_group_by_urutan[$urutan][] = $proses;
        }

        foreach($this->list_proses as $proses) {
            $list_permohonan = $proses->list_permohonan;

            foreach($list_permohonan as $permohonan) {
                $id_permohonan = $permohonan->data_permohonan->ID_PERMOHONAN;
                if(!array_key_exists($id_permohonan, $this->permohonan_set)) {
                    $this->permohonan_set[$id_permohonan] = $permohonan;
                }
            }
        }

        // var_dump($this->permohonan_set);
    }

    private function count_on_track() {
        // $this->on_track_count = array_sum(array_map(
        //     function($item) {
        //         return $item->on_track_count;
        //     }, $this->list_proses)
        // );

        $permohonan_count = 0;
        foreach($this->proses_group_by_urutan as $proses) {
            $permohonan_count += $proses[0]->on_track_count;
        }

        // $this->on_track_count = $permohonan_count;

        // var_dump($this->permohonan_set);
        $this->on_track_count = array_sum(array_map(
            function($item) {
                return ($item->on_track === TRUE ? 1 : 0);
            }, $this->permohonan_set)
        );
    }

    private function count_at_risk() {
        // $this->at_risk_count = array_sum(array_map(
        //     function($item) {
        //         return $item->at_risk_count;
        //     }, $this->list_proses)
        // );

        // $permohonan_count = 0;
        // foreach($this->proses_group_by_urutan as $proses) {
        //     $permohonan_count += $proses[0]->at_risk_count;
        // }

        // $this->at_risk_count = $permohonan_count;

        $this->at_risk_count = array_sum(array_map(
            function($item) {
                return ($item->at_risk === TRUE ? 1 : 0);
            }, $this->permohonan_set)
        );
    }

    private function count_permohonan() {
        // $this->permohonan_count = array_sum(array_map(
        //     function($item) {
        //         return $item->permohonan_count;
        //     }, $this->list_proses)
        // );

        // $permohonan_count = 0;
        // foreach($this->proses_group_by_urutan as $proses) {
        //     $permohonan_count += $proses[0]->permohonan_count;
        // }

        // $this->permohonan_count = $permohonan_count;

        $this->permohonan_count = count($this->permohonan_set);
    }

    private function count_late() {
        $this->late_count = $this->permohonan_count - $this->on_track_count - $this->at_risk_count;
    }
}

class ProsesDetail extends BaseAccessor {
    public $list_permohonan = array(); // Must be type PermohonanDetail

    public $data_proses;
    public $context_template_detail;
    public $permohonan_count = 0;
    public $on_track_count = 0;
    public $at_risk_count = 0;
    public $late_count = 0;

    public function __construct($id_proses, $detail_template) {
        parent::__construct();
        BaseAccessor::get_ci()->load->model("M_proses_skema");
        BaseAccessor::get_ci()->load->model("M_sla_proses_izin");

        $this->data_proses = BaseAccessor::get_ci()->M_proses_skema->get_by_id_proses($id_proses);
        $this->context_template_detail = $detail_template;
        $this->fill_list_permohonan();
    }

    public function get_process_sla() {
        $id_form = $this->context_template_detail->data_template->ID_FORM;
        $id_process = $this->data_proses->ID_PROSES;
        $sla_process = BaseAccessor::get_ci()->M_sla_proses_izin->getProcessSLA($id_form, $id_process)->SLA;
        
        return $sla_process;
    }

    public function get_by_id_permohonan($id_permohonan) {
        $key = array_search($id_permohonan, array_map(
            function($item) {
                return $item->data_permohonan->ID_PERMOHONAN;
            }, $this->list_permohonan)
        );

        if($key === FALSE) {
            return FALSE;
        } else {
            return $this->list_permohonan[$key];
        }
    }

    private function fill_list_permohonan() {
        $list_ongoing_permohonan = BaseAccessor::get_ci()->M_sla_proses_izin->get_list_permohonan_by_template_and_process(
                                                                                        $this->context_template_detail->data_template->ID_TEMPLATE,
                                                                                        $this->data_proses->ID_PROSES);

        foreach($list_ongoing_permohonan as $permohonan) {
            $permohonan_detail = new PermohonanDetail($permohonan->ID_PERMOHONAN);
            array_push($this->list_permohonan, $permohonan_detail);            
        }

        $this->permohonan_count = count($this->list_permohonan);
        $this->count_on_track();
        $this->count_at_risk();
        $this->count_late();
    }

    private function count_on_track() {
        $this->on_track_count = array_sum(array_map(
            function($item) {
                return ($item->on_track === TRUE ? 1 : 0);
            }, $this->list_permohonan)
        );
    }

    private function count_at_risk() {
        $this->at_risk_count = array_sum(array_map(
            function($item) {
                return ($item->at_risk === TRUE ? 1 : 0);
            }, $this->list_permohonan)
        );
    }

    private function count_late() {
        $this->late_count = $this->permohonan_count - $this->on_track_count - $this->at_risk_count;
    }
}

class PermohonanDetail extends BaseAccessor {
    public $data_permohonan;
    public $sla_izin;
    public $ongoing_proses;
    public $day_target;
    public $day_left_count;
    public $on_track;
    public $at_risk;

    public function __construct($id_permohonan) {
		parent::__construct();
        BaseAccessor::get_ci()->load->model("M_r_permohonan_izin");
        BaseAccessor::get_ci()->load->model("M_r_template_izin");
        BaseAccessor::get_ci()->load->model("M_sla_proses_izin");

        //TODO: Make assertion, make sure the context_id_proses is in ongoing proses
        
        // if(empty($this->data_permohonan)) {
        //     die("WRONG PERMOHONAN ID");
        // }
        $this->pre_process($id_permohonan);
        $this->on_track = $this->is_on_track();
    }

    public function get_template_name() {
        $template_data = BaseAccessor::get_ci()->M_r_template_izin->select_by_id($this->data_permohonan->ID_TEMPLATE);

        return $template_data->NAMA_TEMPLATE;
    }

    public function get_proses_ids() {
        $ids = array();

        foreach($this->ongoing_proses as $proses) {
            $ids[] = $proses->ID_PROSES;
        }

        return $ids;
    }

    public function get_process_name_string() {
        $process_name = $this->get_processes_name();

        if(!empty($process_name)) {
            return implode("<br>", $process_name);
        }

        if(!is_null($this->data_permohonan->TGL_DISETUJUI)) {
            return "Permohonan telah disetujui";
        }
        
        if(!is_null($this->data_permohonan->TGL_PENOLAKAN)) {
            return "Permohonan ditolak";
        }
    }

    public function get_processes_name() {
        $names = array();

        foreach($this->ongoing_proses as $proses) {
            $names[] = $proses->NAMA_PROSES;
        }

        return $names;
    }

    public function get_id_form() {
        return $this->data_permohonan->ID_FORM; 
    }

    public function pre_process($id_permohonan) {
        $this->data_permohonan = BaseAccessor::get_ci()->M_r_permohonan_izin->select_permohonan_by_id($id_permohonan);
        $this->ongoing_proses = BaseAccessor::get_ci()->M_r_permohonan_izin->select_ongoing_process($this->data_permohonan->ID_PERMOHONAN);

        $this->sla_izin = BaseAccessor::get_ci()->M_sla_proses_izin->getIzinTotalSla($this->data_permohonan->ID_FORM);

        $this->day_target = $this->get_day_target();
        $this->day_left_count = $this->get_sla_remain();
        $this->at_risk = FALSE;
    }

    public function detail_string($check = NULL) {
        return ($check ? "Iya" : "Tidak");
    }

    // Human readable
    public function summary_status() {
        $status = "On Track";

        if(!$this->on_track) {
            $status = "Overdue";
        }

        if($this->at_risk) {
            $status = "At Risk";
        }

        return $status;
    }

    public function current_status() {
        $status = PerizinanStatus::ON_TRACK;

        if(!$this->on_track) {
            $status = PerizinanStatus::OVERDUE;
        }

        if($this->at_risk) {
            $status = PerizinanStatus::AT_RISK;
        }

        return $status;
    }

    public function get_step_detail() {
        // $id_skema = BaseAccessor::get_ci()->M_izin_instansi->select_by_id($this->data_permohonan->ID_FORM)->ID_SKEMA;
        // $list_process = BaseAccessor::get_ci()->M_proses_skema->select_list_proses($id_skema);
        $step_detail = new StepDetail($this);

        return $step_detail;
    }


    private function get_day_target() {
        $sla_izin = $this->sla_izin;
        $tgl_pengajuan = $this->data_permohonan->TGL_PENGAJUAN;
        $tgl_selesai_izin_sla = Carbon::parse($tgl_pengajuan)->addBusinessDays($sla_izin);

        return $tgl_selesai_izin_sla;
    }

    
    private function get_sla_remain() {
        $sla_remain_count = BaseAccessor::get_ci()->M_sla_proses_izin->getIzinTotalSla($this->data_permohonan->ID_FORM, $this->data_permohonan->CURR_URUTAN_PROSES + 1);

        return $sla_remain_count;
    }
    
    private function is_on_track() {
        

        // if($this->data_permohonan->ID_PERMOHONAN == 220) {
        //     var_dump($sla_izin);
        //     var_dump($tgl_pengajuan);
        //     var_dump($tgl_selesai_izin_sla);
        // }

        // Disetujui
        $tgl_disetujui = $this->data_permohonan->TGL_DISETUJUI;
        if(!is_null($tgl_disetujui)) {
            $is_on_track = Carbon::parse($tgl_disetujui)->lt($this->day_target);

            return $is_on_track;
        }

        // Ditolak
        $tgl_penolakan = $this->data_permohonan->TGL_PENOLAKAN;
        if(!is_null($tgl_penolakan)) {
            $is_on_track = Carbon::parse($tgl_penolakan)->lt($this->day_target);

            return $is_on_track;
        }


        // Ongoing
        $is_on_track = Carbon::now()->lt($this->day_target);

        if($is_on_track) {
            $this->at_risk = $this->is_at_risk();

            if($this->at_risk) {
                $is_on_track = FALSE;
            }
            // echo "On Track: ". encrypted_id_permohonan($this->data_permohonan->ID_PERMOHONAN) ."<br>";
            // echo "On Track: ". ($this->data_permohonan->ID_PERMOHONAN) ."<br>";
        } else {
            // echo "Not On Track ". encrypted_id_permohonan($this->data_permohonan->ID_PERMOHONAN) ."<br>";            
            // echo "Not On Track ". ($this->data_permohonan->ID_PERMOHONAN) ."<br>";            
        }

        return $is_on_track;
    }

    private function is_at_risk() {
        $end_prediction = Carbon::now()->addBusinessDays($this->day_left_count);

        $is_at_risk = $end_prediction->gt($this->day_target);

        return $is_at_risk;
    }

}

class StepDetail extends BaseAccessor {
    public $context_detail_permohonan;
    public $list_tracking_item_id =array();
    public $list_tracking_detail = array();

    public function __construct($detail_permohonan) {
        parent::__construct();
        BaseAccessor::get_ci()->load->model("M_proses_skema");
        BaseAccessor::get_ci()->load->model("M_tracking_proses");

        $this->context_detail_permohonan = $detail_permohonan;

        $this->fill_tracking_detail();
        $this->fill_all_tracking_id();
        $this->set_tgl_at_every_item();
    }

    public function search_tracking_item_with_id($id_tracking) {
        $key = array_search($id_tracking, array_map(
            function($tracking_detail) use ($id_tracking) {
                return issetor($tracking_detail->get_tracking_item_with_id($id_tracking)->data_tracking->ID_TRACKING_PROSES, FALSE);
            }, $this->list_tracking_detail)
        );

        if($key === FALSE) {
            return FALSE;
        } else {
            return $this->list_tracking_detail[$key]->get_tracking_item_with_id($id_tracking);
        }
    }

    public function get_preeceding_tracking_item($id_tracking) {
        $current_key = array_search($id_tracking, array_map(
            function($track_id) {
                return $track_id->ID_TRACKING_PROSES;
            }, $this->list_tracking_item_id)
        );

        if($current_key === FALSE) {
            return FALSE;
        }

        $target_key = $current_key - 1;

        if($target_key < 0) {
            return FALSE;
        }

        return $this->list_tracking_item_id[$target_key];
    }

    private function set_tgl_at_every_item() {
        foreach($this->list_tracking_detail as $tracking_detail) {
            $tracking_detail->set_tgl_real();
        }
    }

    private function fill_tracking_detail() {
        $id_skema = BaseAccessor::get_ci()->M_izin_instansi->select_by_id($this->context_detail_permohonan->data_permohonan->ID_FORM)->ID_SKEMA;
        $list_process = BaseAccessor::get_ci()->M_proses_skema->select_list_proses($id_skema);

        foreach($list_process as $process) {
            $tracking_detail = new TrackingDetail($this, $process);
            array_push($this->list_tracking_detail, $tracking_detail);
        }
    }

    private function fill_all_tracking_id() {
        $list_id = BaseAccessor::get_ci()->M_tracking_proses->get_process_tracking_id($this->context_detail_permohonan->data_permohonan->ID_PERMOHONAN);

        $this->list_tracking_item_id = $list_id;
    }
}

class TrackingDetail extends BaseAccessor {
    public $context_step_detail;
    public $data_proses;
    public $sla_process;
    public $assigned_user_id;
    public $list_tracking_item = array();

    public function __construct($step_detail, $data_proses) {
        parent::__construct();
        BaseAccessor::get_ci()->load->model("M_user");
		BaseAccessor::get_ci()->load->model("M_tracking_proses");

        $this->context_step_detail = $step_detail;

        $this->data_proses = $data_proses;

        $this->fill_tracking_item_detail();
        $this->assigned_user_id = $this->get_assigned_user_id();
        $this->get_sla_process();
    }

    public function get_status_string() {
        $is_on_track = $this->is_on_track();

        if($is_on_track === NULL) {
            return NULL;
        }

        return ($is_on_track ? "On Track" : "Overdue");
    }

    public function get_tracking_item_with_id($id_tracking) {
        $key = array_search($id_tracking, array_map(
            function($tracking_item) {
                return $tracking_item->data_tracking->ID_TRACKING_PROSES;
            }, $this->list_tracking_item)
        );

        if($key === FALSE) {
            return FALSE;
        } else {
            return $this->list_tracking_item[$key];
        }
    }

    public function get_assigned_user_data() {
        // if($this->data_proses->IS_BKPM) {
        //     $bkpm_user = new stdClass;
        //     $bkpm_user->NAMA = "BKPM";

        //     return $bkpm_user;
        // }
        
        $data_user = BaseAccessor::get_ci()->M_user->select_by_id($this->assigned_user_id);


        return $data_user;
    }

    public function set_tgl_real() {
        foreach($this->list_tracking_item as $tracking_item) {
            $tracking_item->set_tgl_real();
        }
    }

    public function get_total_time_elapsed() {
        $total_interval = NULL;

        foreach($this->list_tracking_item as $key => $tracking_item) {
            $item_interval = $tracking_item->get_time_elapsed();

            if($total_interval === NULL) {
                $total_interval = $item_interval;
            } else {
                $total_interval->add($item_interval);
            }
        }

        return $total_interval;
    }

    public function get_total_time_elapsed_string() {
        $diff_in_carbon = $this->get_total_time_elapsed();

        if($diff_in_carbon === NULL) {
            return NULL;
        }

        return parent::get_interval_string($diff_in_carbon);
    }

    private function get_sla_process() {
        $id_form = $this->context_step_detail->context_detail_permohonan->data_permohonan->ID_FORM;
        $id_process = $this->data_proses->ID_PROSES;
        $sla_process = BaseAccessor::get_ci()->M_sla_proses_izin->getProcessSLA($id_form, $id_process)->SLA;
        
        $this->sla_process = $sla_process;
    }

    private function is_on_track() {
        $carbon_elapsed = $this->get_total_time_elapsed();

        if($carbon_elapsed === NULL) {
            return NULL;
        } else {
            $working_interval = $carbon_elapsed->totalDays;
        }

        $sla_carbon = CarbonInterval::days($this->sla_process)->totalDays;
        $is_on_track = $working_interval < $sla_carbon;

        return $is_on_track;
    }

    private function fill_tracking_item_detail() {
        $list_tracking = BaseAccessor::get_ci()->M_tracking_proses->get_process_tracking_data($this->context_step_detail->context_detail_permohonan->data_permohonan->ID_PERMOHONAN, $this->data_proses->ID_PROSES);

        foreach($list_tracking as $tracking) {
            $tracking_item = new TrackingItemDetail($this, $tracking);
            array_push($this->list_tracking_item, $tracking_item);
        }

        // foreach($this->list_tracking_item as $tracking_item) {
        //     $tracking_item->set_tgl_real();
        // }
    }

    private function get_assigned_user_id() {
        if(!empty($this->list_tracking_item)) {
            $first_tracking_data = $this->list_tracking_item[0];
            $user_id = $first_tracking_data->data_tracking->ID_USER;

            return $user_id;
        }

        return NULL;
    }
}

class TrackingItemDetail extends BaseAccessor {
    public $context_tracking_detail;
    public $data_tracking;
    public $tgl_masuk_real;
    public $tgl_selesai_real;

    public function __construct($tracking_detail, $data_tracking) {
        parent::__construct();
        $this->context_tracking_detail = $tracking_detail;
        $this->data_tracking = $data_tracking;
    }

    public function set_tgl_real() {
        $this->count_tgl_selesai_real();
        $this->count_tgl_masuk_real();
    }

    public function get_time_elapsed_string() {
        $diff_in_carbon = $this->get_time_elapsed();

        return parent::get_interval_string($diff_in_carbon);
    }

    public function get_time_elapsed() {
        $tgl_masuk_real_carbon = Carbon::parse($this->tgl_masuk_real);

        if($this->tgl_selesai_real === NULL && !Carbon::now()->isBusinessDay()) {
            $tgl_selesai_real_carbon = Carbon::now()->endOfDay();
        } else {
            $tgl_selesai_real_carbon = Carbon::parse($this->tgl_selesai_real);
        }

        $not_business_day = $this->count_not_business_day($tgl_masuk_real_carbon, $tgl_selesai_real_carbon);
        // var_dump($not_business_day);
        
        $tgl_selesai_real_carbon->subDays($not_business_day);
        
        $diff_in_carbon = $tgl_masuk_real_carbon->diffAsCarbonInterval($tgl_selesai_real_carbon);

        return $diff_in_carbon;
    }

    public function set_and_get_tgl_selesai_real() {
        if($this->tgl_selesai_real === NULL) {
            $this->count_tgl_selesai_real();            
        }

        return $this->tgl_selesai_real;
    }

    public function get_human_tgl_mulai() {
        $tgl_masuk_real = NULL;
        $last_tracking_id = $this->context_tracking_detail->context_step_detail->get_preeceding_tracking_item($this->data_tracking->ID_TRACKING_PROSES);
        
        if($last_tracking_id === FALSE) {
            // TGL_PENGAJUAN
            $tgl_masuk_real = $this->context_tracking_detail->context_step_detail->context_detail_permohonan->data_permohonan->TGL_PENGAJUAN;
        } else {
            $last_tracking_data = $this->context_tracking_detail->context_step_detail->search_tracking_item_with_id($last_tracking_id->ID_TRACKING_PROSES);
            $tgl_masuk_real = $last_tracking_data->get_human_tgl_selesai();
        }

        return $tgl_masuk_real;
    }

    public function get_human_tgl_selesai() {
        return $this->data_tracking->TGL_SELESAI_PROSES;
    }

    // private function get_interval_string($interval) {
    //     $interval_string = array();
        
    //     $this->interval_component_string($interval_string, $interval->y, "tahun");
    //     $this->interval_component_string($interval_string, $interval->m, "bulan");
    //     $this->interval_component_string($interval_string, $interval->d, "hari");
    //     $this->interval_component_string($interval_string, $interval->h, "jam");
        
    //     return implode(" ", $interval_string);
    // }
    
    // private function interval_component_string(&$interval_string, $component, $component_string) {
    //     if($component !== 0) {
    //         $format = "%d %s";
    //         $component_result = sprintf($format, $component, $component_string);

    //         array_push($interval_string, $component_result); // Yeee
    //     }
    // }

    private function count_not_business_day($start_date, $end_date) {
        $period = CarbonPeriod::create($start_date, $end_date);
        $not_business_day_count = 0;

        foreach($period as $key => $date) {
            if(!$date->isBusinessDay()) {
                // var_dump($date);

                $not_business_day_count++;
            }
        }

        return $not_business_day_count;
    }

    private function count_business_day($start_date, $end_date) {
        $period = CarbonPeriod::create($start_date, $end_date);
        $business_day_count = 0;

        foreach($period as $key => $date) {
            if($date->isBusinessDay()) {
                $business_day_count++;
            }
        }

        return $business_day_count;
    }

    private function count_tgl_masuk_real() {
        $tgl_masuk_real = NULL;
        $last_tracking_id = $this->context_tracking_detail->context_step_detail->get_preeceding_tracking_item($this->data_tracking->ID_TRACKING_PROSES);
        
        if($last_tracking_id === FALSE) {
            // TGL_PENGAJUAN
            $tgl_masuk_real = $this->context_tracking_detail->context_step_detail->context_detail_permohonan->data_permohonan->TGL_PENGAJUAN;
        } else {
            $last_tracking_data = $this->context_tracking_detail->context_step_detail->search_tracking_item_with_id($last_tracking_id->ID_TRACKING_PROSES);
            $tgl_masuk_real = $last_tracking_data->set_and_get_tgl_selesai_real();
        }
        
        // if($this->context_tracking_detail->context_step_detail->context_detail_permohonan->data_permohonan->ID_PERMOHONAN == 220
        //     && $last_tracking_id !== FALSE
        //     && $last_tracking_id->ID_TRACKING_PROSES == 381) {
        //     // var_dump($this->data_tracking->ID_TRACKING_PROSES);
        //     // var_dump($last_tracking_data);
        //     // var_dump($last_tracking_id);
        //     // var_dump($tgl_masuk_real);
        // }
        
        $tgl_masuk = parent::get_business_day($tgl_masuk_real, FALSE);

        $this->tgl_masuk_real = $tgl_masuk;
    }

    private function count_tgl_selesai_real() {
        $tgl_selesai_normal = $this->data_tracking->TGL_SELESAI_PROSES;

        if(is_null($tgl_selesai_normal)) {
            $this->tgl_selesai_real = $tgl_selesai_normal;
            return;
        }

        $tgl_selesai = parent::get_business_day($tgl_selesai_normal);

        $this->tgl_selesai_real = $tgl_selesai;
    }
}