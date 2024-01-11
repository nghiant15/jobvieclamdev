<?php

namespace App\Http\Controllers\Job;

use App\Blog;
use App\Slider;
use App\Testimonial;
use App\Video;
use Auth;
use DB;
use Illuminate\Database\Eloquent\Model;
use Input;
use Redirect;
use Carbon\Carbon;
use App\Job;
use App\JobApply;
use App\FavouriteJob;
use App\Company;
use App\JobSkill;
use App\JobSkillManager;
use App\Country;
use App\CountryDetail;
use App\State;
use App\City;
use App\CareerLevel;
use App\FunctionalArea;
use App\JobType;
use App\JobShift;
use App\Gender;
use App\Seo;
use App\JobExperience;
use App\DegreeLevel;
use App\ProfileCv;
use App\Helpers\MiscHelper;
use App\Helpers\DataArrayHelper;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DataTables;
use App\Http\Requests\JobFormRequest;
use App\Http\Requests\Front\ApplyJobFormRequest;
use App\Http\Controllers\Controller;
use App\Traits\FetchJobs;
use App\Events\JobApplied;
use Illuminate\Http\UploadedFile;

class JobController extends Controller
{

    //use Skills;
    use FetchJobs;

    private $functionalAreas = '';
    private $countries = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['jobsBySearch', 'jobDetail','jobDetailPopup', 'latestJobs', 'salaryCalc','searchJobv2']]);

        $this->functionalAreas = DataArrayHelper::langFunctionalAreasArray();
        $this->countries = DataArrayHelper::langCountriesArray();
    }

   

    public function jobsBySearch(Request $request)
    {
        // dd( $this->searchJobv2($request));
         
        $jobList = $this->searchJobv3($request);
      
        
        $params = $this->params2($request); 
     

        /**************************************************** */
     
        $seo = Seo::where('seo.page_title', 'like', 'jobs')->first();

        return view(config('app.THEME_PATH').'.job.list')
                        ->with('functionalAreas', $this->functionalAreas)
                        ->with('countries', $this->countries)
                        ->with('currencies', array_unique($params['currencies']))
                  
                        ->with('jobList',$jobList)
                         ->with('cities', $params['cities'])
                        ->with('funclAreas', $params['funclAreas'])
                        ->with('salaryFroms', $params['salaryFroms'])
                        ->with('degreeLevels', $params['degreeLevels'])
                        ->with('jobTypes', $params['jobTypes'])
                        ->with('benefits', $params['benefits'])
                        ->with('requestParam', $request)
                        ->with('Industrys',$params['Industrys'])
                        ->with('seo', $seo);
    }

    public function jobDetail(Request $request, $job_slug)
    {
        $job = Job::where('slug', 'like', $job_slug)->firstOrFail();
        /*         * ************************************************** */
        $search = '';
        $job_titles = array();
        $company_ids = array();
        $industry_ids = array();
        $job_skill_ids = (array) $job->getJobSkillsArray();
        $functional_area_ids = (array) $job->getFunctionalArea('functional_area_id');
        $country_ids = array();
        $state_ids = array();
        $city_ids = (array) $job->getCity('city_id');
        $is_freelance = $job->is_freelance;
        $career_level_ids = array();
        $job_type_ids = array();
        $job_shift_ids = array();
        $gender_ids = array();
        $degree_level_ids = array();
        $job_experience_ids = array();
        $salary_from = 0;
        $salary_to = 0;
        $salary_currency = '';
        $is_featured = 2;
        $order_by = 'id';
        $limit = 5;
        $jobSkills = DataArrayHelper::defaultJobSkillsArray();

        // $relatedJobs = $this->findJobDetails($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, $order_by, $limit);
        /*         * ***************************************** */

        $seoArray = $this->getSEO((array) $job->functional_area_id, (array) $job->country_id, (array) $job->state_id, (array) $job->city_id, (array) $job->career_level_id, (array) $job->job_type_id, (array) $job->job_shift_id, (array) $job->gender_id, (array) $job->degree_level_id, (array) $job->job_experience_id);
        /*         * ************************************************** */
        $seo = (object) array(
                    'seo_title' => $job->title,
                    'seo_description' => $seoArray['description'],
                    'seo_keywords' => $seoArray['keywords'],
                    'seo_other' => ''
        );

         $jobOfCompany = Job::where('is_active', 1)
                            ->where('company_id',$job->company_id)
                            ->where('id', '!=', $job->id)
                            ->orderby('created_at', 'desc');
        $jobOfCompany = $jobOfCompany->with('company');
        $qujobOfCompanyery =$jobOfCompany->with('functionalArea');
        $jobOfCompany =$jobOfCompany->with('jobType');
        $jobOfCompany =$jobOfCompany->with('degreeLevel');
        $jobOfCompany= $jobOfCompany->with('city');
        $jobOfCompany=  $jobOfCompany->get();

        $relatedJobs = Job::where('is_active', 1)
        ->where("functional_area_id",$job->functional_area_id)
        ->where("industry_id",$job->industry_id)
        ->where('id', '!=', $job->id)->orderby('created_at', 'desc');
        $relatedJobs = $relatedJobs->with('company');
        $relatedJobs =$relatedJobs->with('functionalArea');
        $relatedJobs =$relatedJobs->with('jobType');
        $relatedJobs =$relatedJobs->with('degreeLevel');
        $relatedJobs= $relatedJobs->with('city');
        $relatedJobs = $relatedJobs->paginate(9);
         return view(config('app.THEME_PATH').'.job.detail')
                        ->with('job', $job)
                        ->with('jobOfCompany', $jobOfCompany)
                        ->with('relatedJobs', $relatedJobs)
                        ->with('job_skill_ids', $job_skill_ids)
                        ->with('jobSkills', $jobSkills)
                        ->with('seo', $seo);
    }
    public function jobRelation(Request $request, $job_slug)
    {
        $jobSlug = $request->input("job_slug");
        $job = Job::where('slug', 'like', $job_slug)->firstOrFail();
        if($job)
        {
            $jobRelation = Job::where('is_active', 1)
                        ->where("functional_area_id",$job->functional_area_id)
                        ->where("industry_id",$jobRelation->industry_id)
                        ->where('id', '!=', $jobRelation->id);
            $jobRelation = $jobRelation->with('company');
            $jobRelation =$jobRelation->with('functionalArea');
            $jobRelation =$jobRelation->with('jobType');
            $jobRelation =$jobRelation->with('degreeLevel');
            $jobRelation= $jobRelation->with('city');
             //created_at
            return $query->paginate(10);
        }
        else 
        {
            return null;
        }
       
    
     }

       
    public function jobDetailPopup(Request $request, $job_slug)
    {
        $job = Job::where('slug', 'like', $job_slug)->firstOrFail();
        $job_skill_ids = (array) $job->getJobSkillsArray();
        $jobSkills = DataArrayHelper::defaultJobSkillsArray();
        return view(config('app.THEME_PATH').'.job.detail-popup')
            ->with('job', $job)
            ->with('job_skill_ids', $job_skill_ids)
            ->with('jobSkills', $jobSkills);
    }

    function locdautiengviet($str){
        if(!$str)
        {
            return "";
        }
         //chuyển chữ hoa thành chữ thường
       
        $unicode = array(
        'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
        'd'=>'đ',
        'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
        'i'=>'í|ì|ỉ|ĩ|ị',
        'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
        'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
        'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
        'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
        'D'=>'Đ',
        'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
        'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
        'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
        'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
         'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
         );
         foreach($unicode as $nonUnicode=>$uni){
                $str = preg_replace("/($uni)/i", $nonUnicode, $str);
         }
         $str = str_replace(' ','_',$str);
         $str = strtolower($str);
        
         return $str;
    }
    public function searchJobv2(Request $request)
    {
        $token = $request->input("search");
        
       
        $industry_id = $request->input("industry_id");
        $locationWork = $request->input("provice");
        $orderby = $request->input("sort");
        $wfh = $request->input("wfh");
 
        $salary_min = $request->input("salary_min");
        $salary_max = $request->input("salary_max");
        $levelSkill = $request->input("levelSkill");
        $levelDegree = $request->input("levelDegree");
        $jobtype = $request->input("jobType");
        $departmentType = $request->input("departmentType");
        $benefits = $request->input("benefits");
        $order_by = $request->input("order_by");
        $city_id =  $request->input("city_id");
        $query = Job::where('status', Job::POST_ACTIVE);
        $token = $this->locdautiengviet($token);
        if (!empty($token)) 
        {
            $query =  $query->where("title",'like',"%{$token}%");

        }
        if ($levelDegree >0 ) 
        {
            $query =  $query->where("degree_level_id",$levelDegree);
        }
        if ($departmentType >0 ) 
        {
            $query =  $query->where("functional_area_id",$departmentType);
        }
        
        if ($city_id >0 ) 
        {
            $query =  $query->where("city_id",$city_id);
        }
         //functional_area_id
        if($industry_id>0)
        {
            $query =  $query->where("industry_id",$industry_id);
        }
        if ($wfh == 1 ) 
        {
            $query =  $query->where("wfh",$wfh);
        }

        
        if( $salary_min > 0)
        {
            $query =  $query->where('salary_from', '>=', $salary_min)->get();

        }
        if( $salary_max > 0)
        {
            $query =  $query->where('salary_to', '<=',  $salary_max)->get();
        }
        if ($order_by== "up_top") // last updated
        {
            $query =  $query->orderBy('updated_at', 'DESC');
        }
        else if($order_by== "new") // last updated
        {
            $query =  $query->orderBy('created_at', 'DESC');
        }
        else if($order_by== "older") // last updated
        {
            $query =  $query->orderBy('created_at', 'ASC');
        }
        else 
        {
            $query =  $query->orderBy('created_at', 'DESC');
        }
        $query = $query->with('company');
        $query =$query->with('functionalArea');
        $query =$query->with('jobType');
        $query =$query->with('degreeLevel');
        $query= $query->with('city');

      
        //created_at
        return $query->paginate(10);
    }

    public function searchJobv3(Request $request)
    {
        $token = $request->input("search");
    
       
        $industry_id = $request->input("industry_id");
        if ($request->has("fe_industry_id")){
            $industry_id =  $request->input("fe_industry_id");
        }
    
        $locationWork = $request->input("provice");
        $orderby = $request->input("sort");
        $wfh = $request->input("wfh");
 
        $salary_min = $request->input("salary_min");
        $salary_max = $request->input("salary_max");
        $levelSkill = $request->input("levelSkill");
        $levelDegree = $request->input("degree_level_id");
        $jobtype = $request->input("job_type_id");
        $departmentType = $request->input("functional_area_id");
        $benefits = $request->input("benefits");
        $order_by = $request->input("order_by");
        $city_id =  $request->input("city_id");
      
        
        $query = Job::where('status', Job::POST_ACTIVE);
        $token = $this->locdautiengviet($token);
        if (!empty($token)) 
        {
            $query =  $query->where("title",'like',"%{$token}%");

        }
        if ($levelDegree >0 ) 
        {
            $query =  $query->where("degree_level_id",$levelDegree);
        }
        if ($departmentType >0 ) 
        {
            $query =  $query->where("functional_area_id",$departmentType);
        }
      
        
        if ($city_id >0 ) 
        {
            $query =  $query->where("city_id",$city_id);
        }
         //functional_area_id
        if($industry_id>0)
        {
            $query =  $query->where("industry_id",$industry_id);
        }
        if ($wfh == 1 ) 
        {
            $query =  $query->where("wfh",$wfh);
        }

       
        if( $salary_min > 0)
        {
            $query =  $query->where('salary_from', '>=', $salary_min);

        }
        
        if( $salary_max > 0)
        {
            $query =  $query->where('salary_to', '<=',  $salary_max);
        }
        $order_by = 'new';

    
        if ($order_by== "up_top") // last updated
        {
            $query =  $query->orderBy('updated_at', 'DESC');
        }
        else if($order_by== "new") // last updated
        {
            $query =  $query->orderBy('created_at', 'DESC');
        }
        else if($order_by== "older") // last updated
        {
            $query =  $query->orderBy('created_at', 'ASC');
        }
        else 
        {
            $query =  $query->orderBy('created_at', 'DESC');
        }

      
        $query = $query->with('company');
        $query =$query->with('functionalArea');
        $query =$query->with('jobType');
        $query =$query->with('degreeLevel');
        $query= $query->with('city');

      
        //created_at
        return $query->paginate(10);
    }

    public function findJobDetails($search = '', $wfh = '', $job_titles = array(), $company_ids = array(),
                                   $industry_ids = array(), $job_skill_ids = array(), $functional_area_ids = array(),
                                   $country_ids = array(), $state_ids = array(), $city_ids = array(), $is_freelance = -1,
                                   $career_level_ids = array(), $job_type_ids = array(), $job_shift_ids = array(),
                                   $gender_ids = array(), $degree_level_ids = array(), $job_experience_ids = array(),
                                   $salary_from = 0, $salary_to = 0, $salary_currency = '', $is_featured = -1,
                                   $orderBy = 'id', $limit = 10, $fe_industries_ids = array()) {
        $query = Job::where('status', Job::POST_ACTIVE)
        ->select(array_merge($this->fields, ['jobs.salary_currency', 'jobs.salary_type']));
        if(count($fe_industries_ids) > 0) {
            $query->whereIn('industry_id', $fe_industries_ids);
        }
        $active_company_ids_array = Company::where('is_active', 1)->pluck('id')->toArray();
        if (isset($company_ids[0]) && isset($active_company_ids_array[0])) {
            $company_ids = array_intersect($company_ids,$active_company_ids_array);
        }
		$company_ids_array=array();

        if (isset($industry_ids[0])) {
            $company_ids_array = Company::whereIn('industry_id', $industry_ids)->pluck('id')->toArray();
            if (isset($company_ids[0]) && isset($company_ids_array[0])) {
                $company_ids = array_intersect($company_ids_array, $company_ids);
            }
            $company_ids = $company_ids_array;
        }
          if (isset($company_ids[0])) {
            $query->whereIn('jobs.company_id', $company_ids);
        }   
        $query->where('jobs.is_active', 1);
        if ($search != '') {
            $query = $query->Where('title', 'like', '%' . $search . '%');
            // $query = $query->whereRaw("MATCH (`search`) AGAINST ('$search*' IN BOOLEAN MODE)");
        }

        if ($wfh != '') {
            $query = $query->Where('wfh', $wfh);
            // $query = $query->whereRaw("MATCH (`search`) AGAINST ('$search*' IN BOOLEAN MODE)");
        }

        if (isset($city_ids[0])) {
            $query->whereIn('jobs.city_id', $city_ids);
        }

        if (isset($job_type_ids[0])) {
           $query->whereIn('jobs.job_type_id', $job_type_ids);
        }
        if (isset($career_level_ids[0])) {
            $query->whereIn('jobs.career_level_id', $career_level_ids);
        }
        if (isset($degree_level_ids[0])) {
            $query->whereIn('jobs.degree_level_id', $degree_level_ids);
        }
        if (isset($job_skill_ids[0])) {
            $query->whereHas('jobSkills', function($query) use ($job_skill_ids) {
                $query->whereIn('job_skill_id', $job_skill_ids);
            });
            //$job_ids = JobSkillManager::whereIn('job_skill_id',$job_skill_ids)->pluck('job_id')->toArray();
            //$query->whereIn('jobs.id', $job_ids);
        }
        if (isset($functional_area_ids[0])) {
            $query->whereIn('jobs.functional_area_id', $functional_area_ids);
        }
        
        if ($is_freelance == 1) {
            $query->where('jobs.is_freelance', $is_freelance);
        }
        if (isset($career_level_ids[0])) {
            $query->whereIn('jobs.career_level_id', $career_level_ids);
        }
        if (isset($job_type_ids[0])) {
            $query->whereIn('jobs.job_type_id', $job_type_ids);
        }
        if (isset($job_shift_ids[0])) {
            $query->whereIn('jobs.job_shift_id', $job_shift_ids);
        }
        if (isset($gender_ids[0])) {
            $query->whereIn('jobs.gender_id', $gender_ids);
        }
        if (isset($degree_level_ids[0])) {
            $query->whereIn('jobs.degree_level_id', $degree_level_ids);
        }
        if (isset($job_experience_ids[0])) {
            $query->whereIn('jobs.job_experience_id', $job_experience_ids);
        }
        if (isset($salary_from[0]) && (int) $salary_from[0] > 0) {
            $query->where('jobs.salary_from', '>=', $salary_from);
        }
        if (isset($salary_to[0])  && (int) $salary_to[0] > 0) {
            $query = $query->whereRaw("(`jobs`.`salary_to` - $salary_to) >= 0");
            //$query->where('jobs.salary_to', '<=', $salary_to);
        }
        if (!empty(trim($salary_currency))) {
            $query->where('jobs.salary_currency', 'like', $salary_currency);
        }
        if ($is_featured == 1) {
            $query->where('jobs.is_featured', '=', $is_featured);
        }

        $query->orderBy('jobs.id', 'DESC');
        return $query->paginate($limit);
    }



    /*     * ************************************************** */

    public function addToFavouriteJob(Request $request, $job_slug)
    {
        $data['job_slug'] = $job_slug;
        $data['user_id'] = Auth::user()->id;
        $data_save = FavouriteJob::create($data);
        flash(__('Job has been added in favorites list'))->success();

        return redirect()->back();
        // return \Redirect::route('job.detail', $job_slug);
    }

    public function removeFromFavouriteJob(Request $request, $job_slug)
    {
        $user_id = Auth::user()->id;
        FavouriteJob::where('job_slug', 'like', $job_slug)->where('user_id', $user_id)->delete();

        flash(__('Job has been removed from favorites list'))->success();
        
        return redirect()->back();
        // return \Redirect::route('job.detail', $job_slug);
    }

    public function applyJob(Request $request, $job_slug)
    {
        $user = Auth::user();
        $job = Job::where('slug', 'like', $job_slug)->first();
        $company = Company::where('id', $job->company_id)->first();
        $city = City::where('id', $job->city_id)->first();

        $maxFileSize = UploadedFile::getMaxFilesize() / (1048576);
        
        if ((bool)$user->is_active === false) {
            flash(__('Your account is inactive contact site admin to activate it'))->error();
            return \Redirect::route('job.detail', $job_slug);
            exit;
        }
        
        if ((bool) config('jobseeker.is_jobseeker_package_active')) {
            if (
                    ($user->jobs_quota <= $user->availed_jobs_quota) ||
                    ($user->package_end_date->lt(Carbon::now()))
            ) {
                flash(__('Please subscribe to package first'))->error();
                return \Redirect::route('home');
                exit;
            }
        }
        if ($user->isAppliedOnJob($job->id)) {
            flash(__('You have already applied for this job'))->success();
            return \Redirect::route('job.detail', $job_slug);
            exit;
        }
        

        #$myCvs = ProfileCv::where('user_id', '=', $user->id)->pluck('title', 'id')->toArray();
        $myCv = ProfileCv::where('user_id', '=', $user->id)->first();

        return view(config('app.THEME_PATH').'.user.applyjob') //.job.apply_job_form') //
                        ->with('job_slug', $job_slug)
                        ->with('job', $job)
                        ->with('company', $company)
                        ->with('city', $city)
                        ->with('maxFileSize', $maxFileSize)
                        ->with('myCv', $myCv);
    }

    public function postApplyJob(Request $request, $job_slug)
    {
        $user = Auth::user();
    
        $user_id = $user->id;
        
        $job = Job::where('slug', 'like', $job_slug)->firstOrFail();
        $profileCv = ProfileCv::where('user_id', '=', $user_id)->first();

        if($request->your_resume == 0) {
            
            if(!$profileCv) {
                if($profileCv == null)
                {
                    $itemInsert2 = new ProfileCv();
                    $itemInsert2->user_id = $user_id;
                    $itemInsert2->title = "sử dụng mẫu hồ sơ";
                    $itemInsert2->type = 1;
                    $itemInsert2->cvLink = "http://jobvieclam.com";
                    $itemInsert2->jobId = $job->id;
                    $itemInsert2->save();
                    $cvId = $itemInsert2->id;
                }
                
                // flash(__('You need to update the CV file from the template'))->error();
                // return redirect()->back();
            }
          

        }else {
            if($request->file('customFile')){
                $request->validate([
                    'customFile' => 'required|mimes:doc,docx,pdf|max:2048',
                ],
                [
                    'customFile.mimes' => __('Only doc, docx, pdf files are allowed'),
                    'customFile.max' => __('File size should be less than 2MB')
                ]);
    
                $file = $request->file('customFile');
                $file_ext = $file->getClientOriginalExtension();
                $file_name = $file->getClientOriginalName();
                $file_path = $file->getRealPath();
                $file_hash = md5_file($file_path);
                $file_hash_name = $file_hash . '.' . $file_ext;
                $file->move('cvs/', $file_hash_name);
                $itemInsert =  $profileCv;
                if($itemInsert == null)
                {
                    $itemInsert = new ProfileCv();  
                    $itemInsert->user_id = $user_id;
                    $itemInsert->title = $file_name;
                    $itemInsert->cv_file = $file_hash_name;

                    $itemInsert->type = 0;
                    $itemInsert->cvLink = "http://jobvieclam.com";
                    $itemInsert->jobId = $job->id;
                    $itemInsert->save();
                }
                else 
                {
                    $itemInsert->user_id = $user_id;
                    $itemInsert->title = $file_name;
                    $itemInsert->cv_file = $file_hash_name;

                    $itemInsert->type = 0;
                    $itemInsert->cvLink = "http://jobvieclam.com";
                    $itemInsert->jobId = $job->id;
                    $itemInsert->update();
                }

                $cvId = $itemInsert->id;

            }
        }

        $jobApply = new JobApply();
        $jobApply->user_id = $user_id;
        $jobApply->job_id = $job->id;
        $jobApply->cv_id = $cvId;
        $jobApply->save();

        /*         * ******************************* */
        if ((bool) config('jobseeker.is_jobseeker_package_active')) {
            $user->availed_jobs_quota = $user->availed_jobs_quota + 1;
            $user->update();
        }
        /*         * ******************************* */
        event(new JobApplied($job, $jobApply));

        flash(__('You have successfully applied for this job'))->success();
        return \Redirect::route('job.detail', $job_slug);
    }

    public function myJobApplications(Request $request)
    {
        $myAppliedJobIds = Auth::user()->getAppliedJobIdsArray();
        $user = Auth::user();
        // $jobs = Job::whereIn('id', $myAppliedJobIds)->paginate(10);
        $jobs = Job::join('job_apply', 'jobs.id', '=', 'job_apply.job_id')
                ->where('job_apply.user_id', $user->id)
                ->orderBy('job_apply.id', 'desc')
                ->select('jobs.*',  'job_apply.created_at as applyDate','job_apply.status as status_job_apply')
                ->paginate(10);

        return view(config('app.THEME_PATH').'.job.my_applied_jobs')
                        ->with('jobs', $jobs);
    }

    public function myFavouriteJobs(Request $request)
    {
       
       
        $user = Auth::user();
        $jobs = Job::join('favourites_job', 'jobs.slug', '=', 'favourites_job.job_slug')
                ->where('user_id', $user->id)
                ->orderBy('favourites_job.id', 'desc')
                ->select('jobs.*')
                ->paginate(10);

        return view(config('app.THEME_PATH').'.job.my_favourite_jobs')
                        ->with('jobs', $jobs);
    }


    public function latestJobs(Request $request)
    {

        $latestJobs = Job::active()->notExpire()->orderBy('id', 'desc')->limit(18)->get();
        $currencies = DataArrayHelper::currenciesArray();
        $seo = SEO::where('seo.page_title', 'like', 'front_index_page')->first();
        return view(config('app.THEME_PATH').'.job.latest-jobs')
                        ->with('latestJobs', $latestJobs)
                         ->with('currencies', array_unique($currencies))
                        ->with('seo', $seo);

    }


    public function salaryCalc(Request $request)

    {

        $params = $this->params($request);


        /*         * ************************************************** */

        $seo = Seo::where('seo.page_title', 'like', 'jobs')->first();
        return view(config('app.THEME_PATH').'.job.salary_calc')
            ->with('functionalAreas', $this->functionalAreas)
            ->with('countries', $this->countries)
            ->with('currencies', array_unique($params['currencies']))
            ->with('jobs', $params['jobs'])
            ->with('jobTitlesArray', $params['jobTitlesArray'])
            ->with('skillIdsArray', $params['skillIdsArray'])
            ->with('countryIdsArray', $params['countryIdsArray'])
            ->with('stateIdsArray', $params['stateIdsArray'])
            ->with('cityIdsArray', $params['cityIdsArray'])
            ->with('companyIdsArray', $params['companyIdsArray'])
            ->with('industryIdsArray', $params['industryIdsArray'])
            ->with('functionalAreaIdsArray', $params['functionalAreaIdsArray'])
            ->with('careerLevelIdsArray', $params['careerLevelIdsArray'])
            ->with('jobTypeIdsArray', $params['jobTypeIdsArray'])
            ->with('jobShiftIdsArray', $params['jobShiftIdsArray'])
            ->with('genderIdsArray', $params['genderIdsArray'])
            ->with('degreeLevelIdsArray', $params['degreeLevelIdsArray'])
            ->with('jobExperienceIdsArray', $params['jobExperienceIdsArray'])
            ->with('seo', $seo);
    }
   
    public function params(Request $request)
    {
        
        $search = $request->query('search', '');
        $wfh = $request->query('wfh', '');
        $job_titles = $request->query('job_title', array());
        $company_ids = $request->query('company_id', array());
        $industry_ids = $request->query('industry_id', array());
        $fe_industry_ids = $request->query('fe_industry_id', array());
        $fe_industry_ids = is_array($fe_industry_ids) ? $fe_industry_ids : (array)$fe_industry_ids;
        $job_skill_ids = $request->query('job_skill_id', array());
        $functional_area_ids = $request->query('functional_area_id', array());
        $country_ids = $request->query('country_id', array());
        $state_ids = $request->query('state_id', array());
        $city_ids = $request->query('city_id', array());
        $is_freelance = $request->query('is_freelance', array());
        $career_level_ids = $request->query('career_level_id', array());
        $job_type_ids = $request->query('job_type_id', array());
        $job_shift_ids = $request->query('job_shift_id', array());
        $gender_ids = $request->query('gender_id', array());
        $degree_level_ids = $request->query('degree_level_id', array());
        $job_experience_ids = $request->query('job_experience_id', array());
        $salary_from = $request->query('salary_from', '');
        $salary_to = $request->query('salary_to', '');
        $salary_currency = $request->query('salary_currency', '');
        $is_featured = $request->query('is_featured', 2);
        $order_by = $request->query('order_by', 'id');
        $limit = 15;
        $jobs = $this->findJobDetails($search, $wfh, $job_titles, $company_ids, $industry_ids,
        $job_skill_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids,
        $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to,
        $salary_currency, $is_featured, $order_by, $limit, $fe_industry_ids);
        
        $companyIdsArray = $this->fetchIdsArray($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, 'jobs.company_id');
        $jobIdsArray = $this->fetchIdsArray($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, 'jobs.id');
        $benefits = \App\Benefit::pluck('name', 'code')->toArray();
        $benefits = array_map(function($v){return __($v);}, $benefits);
        return [
           'jobs' => $jobs,
            /*         * ************************************************** */
    
            'jobTitlesArray' => $this->fetchIdsArray($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, 'jobs.title'),
    
            /*         * ************************************************* */
    
            'jobIdsArray' => $jobIdsArray,
            /*         * ************************************************** */
    
            'skillIdsArray' => $this->fetchSkillIdsArray($jobIdsArray),
    
            /*         * ************************************************** */
    
            'countryIdsArray' => $this->fetchIdsArray($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, 'jobs.country_id'),

            /*         * ************************************************** */
    
            'stateIdsArray' => $this->fetchIdsArray($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, 'jobs.state_id'),
    
            /*         * ************************************************** */
    
            'cityIdsArray' => $this->fetchIdsArray($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, 'jobs.city_id'),
    
            /*         * ************************************************** */
    
            'companyIdsArray' => $companyIdsArray,
            /*         * ************************************************** */
    
            'industryIdsArray' => $this->fetchIndustryIdsArray($companyIdsArray),
    
            /*         * ************************************************** */
    
    
            /*         * ************************************************** */
    
            'functionalAreaIdsArray' => $this->fetchIdsArray($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, 'jobs.functional_area_id'),
    
            /*         * ************************************************** */
    
            'careerLevelIdsArray' => $this->fetchIdsArray($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, 'jobs.career_level_id'),
    
            /*         * ************************************************** */
    
            'jobTypeIdsArray' => $this->fetchIdsArray($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, 'jobs.job_type_id'),
    
            /*         * ************************************************** */
    
            'jobShiftIdsArray' => $this->fetchIdsArray($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, 'jobs.job_shift_id'),
    
            /*         * ************************************************** */
    
            'genderIdsArray' => $this->fetchIdsArray($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, 'jobs.gender_id'),
    
            /*         * ************************************************** */
    
            'degreeLevelIdsArray' => $this->fetchIdsArray($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, 'jobs.degree_level_id'),
    
            /*         * ************************************************** */
    
            'jobExperienceIdsArray' => $this->fetchIdsArray($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, 'jobs.job_experience_id'),
    
            /*         * ************************************************** */
    
            'seoArray' => $this->getSEO($functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids),
    
            /*         * ************************************************** */
    
            'currencies' => DataArrayHelper::currenciesArray(),
            'cities' => \App\City::where('lang', \App::getLocale())->active()->pluck('city', 'id')->toArray(),
            'funclAreas' => \App\FunctionalArea::where('lang', \App::getLocale())->active()->pluck('functional_area', 'id')->toArray(),
            'salaryFroms' => DataArrayHelper::langSalaryFromArray(),
            'degreeLevels' => \App\DegreeLevel::where('lang', \App::getLocale())->active()->pluck('degree_level', 'id')->toArray(),
            'jobTypes' => \App\JobType::where('lang', \App::getLocale())->active()->pluck('job_type', 'id')->toArray(),
            'benefits' => $benefits,
        ];

    }


    public function params2(Request $request)
    {
        
        $search = $request->query('search', '');
        $wfh = $request->query('wfh', '');
        $job_titles = $request->query('job_title', array());
        $company_ids = $request->query('company_id', array());
        $industry_ids = $request->query('industry_id', array());
        $fe_industry_ids = $request->query('fe_industry_id', array());
        $fe_industry_ids = is_array($fe_industry_ids) ? $fe_industry_ids : (array)$fe_industry_ids;
        $job_skill_ids = $request->query('job_skill_id',  '');
        $functional_area_ids = $request->query('functional_area_id', '');
        $country_ids = $request->query('country_id',  '');
        $state_ids = $request->query('state_id', '');
        $city_ids = $request->query('city_id', '');
        $is_freelance = $request->query('is_freelance', '');
        $career_level_ids = $request->query('career_level_id', '');
        $job_type_ids = $request->query('job_type_id', '');
        $job_shift_ids = $request->query('job_shift_id', '');
        $gender_ids = $request->query('gender_id', '');
        $degree_level_ids = $request->query('degree_level_id', '');
        $job_experience_ids = $request->query('job_experience_id', '');
        $salary_from = $request->query('salary_from', '');
        $salary_to = $request->query('salary_to', '');
        $salary_currency = $request->query('salary_currency', '');
        $is_featured = $request->query('is_featured', 2);
        $order_by = $request->query('order_by', 'id');
        $limit = 15;
      
   
      
        $benefits = \App\Benefit::pluck('name', 'code')->toArray();

        $benefits = array_map(function($v){return __($v);}, $benefits);

        return [
        
            
            'currencies' => DataArrayHelper::currenciesArray(),
            'cities' => \App\City::where('lang', \App::getLocale())->active()->pluck('city', 'id')->toArray(),
            'Industrys'=>\App\Industry::where('lang', \App::getLocale())->active()->pluck('industry', 'id')->toArray(),
            'funclAreas' => \App\FunctionalArea::where('lang', \App::getLocale())->active()->pluck('functional_area', 'id')->toArray(),
            'salaryFroms' => DataArrayHelper::langSalaryFromArray(),
            'degreeLevels' => \App\DegreeLevel::where('lang', \App::getLocale())->active()->pluck('degree_level', 'id')->toArray(),
            'jobTypes' => \App\JobType::where('lang', \App::getLocale())->active()->pluck('job_type', 'id')->toArray(),
            'benefits' => $benefits,
        ];

    }


}
