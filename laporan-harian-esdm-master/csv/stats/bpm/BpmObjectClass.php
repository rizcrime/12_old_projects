<?php



class ResponseExposedProcess{
   public $status;
   public $errorMessage;
   public $exposedItemList = [];
}

class ResponseStartProcess{
   public $status;
   public $errorMessage;
   public $exceptionType;
   public $name;
   public $piid;
   public $caseFolderID;
   public $processAppName;
   public $processAppAcronym;
   public $snapshotID;
   public $branchID;
   public $tkiid;
   public $taskName;
   public $taskStatus;
   public $taskAssignedTo;
   public $dueTime;
   public $serviceID;
   public $serviceSnapshotID;
   public $flowObjectID;

}

class ResponseRunQuery{
	public $status;
	public $errorMessage;
    public $exceptionType;
    public $taskList = [];
}

class Task{
	public $bpdName;
	public $instanceDueDate;
	public $instanceId;
	public $instanceName;
	public $instanceStatus;
	public $taskDueDate;
	public $taskId;
	public $taskPriority;
	public $taskStatus;
	public $taskSubject;
}

class ExposedItem{
   public $type;
   public $itemID;
   public $processAppID;
   public $processAppName;
   public $startURL;
   public $branchID;
   public $display;
}

class Permohonan{
   public $idPermohonan;
   public $jenisIzin;
   public $namaPerusahaan;
   public $idPerusahaan;
   public $npwp;
   public $tglPengajuan;
   public $statusPermohonan;
   public $isTolak;
   public $isBacktoEvaluator;
   public $ditolakBy;
   public $catatanEvaluator;
   public $catatanEselon2;
   public $catatanEselon3;
   public $catatanEselon4;
   public $catatanInvestor;
   public $currentUser;
}

class ResponseSetData{
	public $status;
	public $errorMessage;
	public $data;
	public $exceptionType;
}

class ResponseGetData{
	public $status;
	public $errorMessage;
	public $data;
	public $exceptionType;
	//public $permohonan;
}



?>