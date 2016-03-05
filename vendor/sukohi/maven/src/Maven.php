<?php namespace Sukohi\Maven;
use View;
use Auth;



class Maven {

    public function __construct()
    {
        //$this->vnas_records = Vnas_record::all();
//        $this->middleware('auth');
        View::composer('*', 'App\Composers\HomeComposer');
    }
    
	private $_tags = [];

	public function tag($tag) {

		if(!is_array($tag)) {

			$tag = [$tag];

		}

		$this->_tags = array_merge($this->_tags, $tag);
		array_unique($this->_tags);
		return $this;

	}

	public function get($limit = 30) {

		$faqs = Faq::where('draft_flag', false)
					->orderBy('sort', 'ASC');

		if(count($this->_tags) > 0) {

			$faqs->where(function($query){

				foreach ($this->_tags as $tag) {

					$query->orWhere('tags', 'LIKE', '%"'. $tag .'"%');

				}

			});

		}

		return $faqs->paginate($limit);

	}

	public function manage_view($limit = 30) {

		$message = '';
		$keyword = '';

		if(\Request::has('remove_id')) {

			$faq = Faq::find(\Request::get('remove_id'));
			$faq->delete();
			$message = 'Complete!';

			$faqs = Faq::orderBy('id', 'ASC')->get();
			\Cahen::align($faqs, 'sort');

		} else if(\Request::has('_token')) {

			if(\Request::has(['question', 'answer'])) {

				$faq = Faq::firstOrNew(['id' => \Request::get('id')]);
				$faq->question = \Request::get('question');
				$faq->answer = \Request::get('answer');
				$faq->tags = explode(',', \Request::get('tags'));
				$faq->draft_flag = \Request::has('draft_flag');
				$faq->save();
				\Cahen::move($faq)->to('sort', \Request::get('sort'));

				$message = 'Complete!';
				\Request::merge([
					'question' => '',
					'answer' => '',
					'tags' => '',
					'sort' => '',
					'draft_flag' => '',
					'id' => '',
				]);

			} else {

				$message = '[Error] Question and Answer are required.';

			}

		} else if(\Request::has('id')) {

			$faq = Faq::find(\Request::get('id'));

			\Request::merge([
				'question' => $faq->question,
				'answer' => $faq->raw_answer,
				'tags' => implode(',', $faq->tags),
				'sort' => $faq->sort_number,
				'draft_flag' => $faq->draft_flag
			]);

		}

		$faqs = Faq::orderBy('sort', 'ASC')
					->paginate($limit);
		$sort_values = Faq::sortSelectValues();
		$tag_values = Faq::tagValues();

		return view('maven::manage', [
				'faqs' => $faqs,
				'sort_values' => $sort_values,
				'tag_values' => $tag_values,
				'message' => $message,
				'keyword' => $keyword
		])->render();

	}

	public function view($limit = 30) {
		$keyword = '';
		$message = '';

		$isCareGiver    = Auth::user()->caregiver_role;
        $isPatient      = Auth::user()->patient_role;
        $my_role   = "";

        if( $isCareGiver != "" )
        {
			 $my_role = "caregiver";       	
        }
        else if( $isPatient != "" )
        {
        	 $my_role = "patient"; 
        }

		$faqs = Faq::orderBy('sort', 'ASC')
					->where(function($q)  use ($my_role){
						$q->where( 'faq_role' , '' )
						->orWhere( 'faq_role' , "$my_role" );
					})
					->paginate($limit);
		$sort_values = Faq::sortSelectValues();
		$tag_values = Faq::tagValues();



		return view('maven::untag', [
				'faqs' => $faqs,
				'sort_values' => $sort_values,
				'tag_values' => $tag_values,
				'message' => $message,
				'keyword' => $keyword
		])->render();
	}

	public function search($keyword,$limit = 30) {
	
		$message = '';

		$isCareGiver    = Auth::user()->caregiver_role;
        $isPatient      = Auth::user()->patient_role;
        $my_role   = "";

        if( $isCareGiver != "" )
        {
			 $my_role = "caregiver";       	
        }
        else
        {
        	 $my_role = "patient"; 
        }

		$faqs = Faq::where( 'question' , 'LIKE' , "%{$keyword}%" )
			->where(function($q) use ($my_role){
				$q->where( 'faq_role' , '' )
					->orWhere( 'faq_role' , $my_role );
			})
			->orderBy('sort', 'ASC')
			->paginate($limit);
		
		$sort_values = Faq::sortSelectValues();
		
		$tag_values = Faq::tagValues();

		return view('maven::untag', [
		   		'faqs' => $faqs, //keyword goes here?
		  		'sort_values' => $sort_values,
		  		'tag_values' => $tag_values,
		  		'message' => $message,
		  		'keyword' => $keyword
		 ])->render();
	}

}