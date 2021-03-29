<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\Models\Poll;
use App\Models\PollQuestionAns;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Toastr;
class PollController extends Controller
{

    public function list()
    {
        $data['polls'] = Poll::all();
        $data['reporters'] = User::where('role_id', 2)->orWhere('role_id', 4)->orWhere('role_id', 5)->get();
        return view('backend.poll.index')->with($data);
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $user_id = Auth::id();
        $poll = new Poll();
        $poll->user_id = $user_id;
        $poll->question_title = $request->question_title;
        $poll->start_date = $request->start_date;
        $poll->end_date = $request->end_date;
        $poll->bg_color = $request->bg_color;
        $poll->text_color = $request->text_color;
        $poll->login_status = ($request->login_status) ? 1 : 0;
        $poll->status = ($request->status) ? 1 : 0;
        $store = $poll->save();
        if($store){
            if(!empty($request->options)){
                $pollOption = [];
                foreach($request->options as $option){
                    if($option) {
                        $pollOption[] = ['poll_id' => $poll->id, 'option' => $option ];
                    }
                }
                if ( !empty(array_filter($pollOption))) {
                    PollQuestionAns::insert($pollOption);
                }
            }
            Toastr::success('Poll created success.', 'success');
        }else{
             Toastr::error('Poll create failed!.', 'error');
        }

        return back();
    }

    public function edit($poll_id)
    {
        $poll = Poll::find($poll_id);
        return view('backend.poll.edit')->with(compact('poll'));
    }


    public function update(Request $request)
    {
        $user_id = Auth::id();
        $poll = Poll::find($request->id);
        $poll->question_title = $request->question_title;
        $poll->start_date = $request->start_date;
        $poll->end_date = $request->end_date;
        $poll->bg_color = $request->bg_color;
        $poll->text_color = $request->text_color;
        $poll->login_status = ($request->login_status) ? 1 : 0;
        $poll->status = ($request->status) ? 1 : 0;
        $update = $poll->save();
      
        if($update){
            if(!empty($request->options)){
                $pollOption = [];
                foreach($request->options as $option){
                    if($option) {
                        $pollOption[] = ['poll_id' => $poll->id, 'option' => $option ];
                    }
                }
                if ( !empty(array_filter($pollOption))) {
                    PollQuestionAns::insert($pollOption);
                }
            }
            Toastr::success('Poll update success.', 'success');
        }else{
             Toastr::error('Poll update failed!.', 'error');
        }

        return back();
    }
    // delete
    public function delete($id)
    {
        $delete =  Poll::find($id);
        if($delete){
            $delete->delete();
            $output = [
                'status' => true,
                'msg' => 'Poll delete successfull.'
            ];

        }else{
            $output = [
                'status' => false,
                'msg' => 'Sorry poll can\'t deleted.'
            ];
        }
        return response()->json($output);
    }

}
