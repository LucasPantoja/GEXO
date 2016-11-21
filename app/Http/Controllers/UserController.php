<?php

namespace gexo\Http\Controllers;

use Request;
use Session;
use Auth;
use gexo\Question;
use gexo\Invite;
use gexo\User;
use gexo\Field;
use gexo\SocialAccount;
use gexo\Http\Requests\InviteRequest;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('UserVerify');
    }

    public function Home(){
        $invites = Invite::where('from_user_id', Auth::user()->id)->get();
        $facebook = SocialAccount::where('user_id', Auth::user()->id)->exists();
    	$questions = Question::where('user_id', Auth::user()->id)->get();
    	return view('user.home')->with('questions', $questions)
                                ->with('facebook', $facebook)
                                ->with('invites', $invites);
    }

    public function Visitor($id){
    	$visitor = User::find($id);
    	$questions = Question::where('user_id', $visitor->id)->get();

    	return view('user.visitor')->with('visitor', $visitor)
    							   ->with('questions', $questions);
    }

    public function Rank(){
        $users = User::orderBy('total_points', 'desc')->get();
        $fields = Field::orderBy('title', 'asc')->get();
        return view('user.rank')->with('users', $users)
                                ->with('fields', $fields);
    }

    public function PointingLab(){
        $answers = Request::input('answer');
        $levels = Request::input('question_level');
        $quantity = Session::get('quantity');
        $points = 0;
        $userpoints = Auth::user()->points;

        for ($i=0; $i < $quantity; $i++) { 
            if ($levels[$i] == 0 && $answers[$i] == 1) {
                $points = $points + 1;
            }elseif($levels[$i] == 1 && $answers[$i] == 1){
                $points = $points + 3;
            }elseif($levels[$i] == 2 && $answers[$i] == 1){
                $points = $points + 5;
            }
        }

        Session::put('answers', $answers);
        Session::put('points', $points);

        Auth::user()->update(['total_points' => $userpoints + $points]);

        return redirect()->action("LabController@Result");
    }

    public function Upgrade(){
        return view('user.upgrade');
    }

    public function UpAccount(InviteRequest $request){
        $invite = Invite::where('key', $request->key)
                               ->where('used', false)
                               ->exists();

        if ($invite != false) {
            $invite1 = new Invite(['from_user_id' => Auth::user()->id, 'key' => str_random(30)]);
            $invite2 = new Invite(['from_user_id' => Auth::user()->id, 'key' => str_random(30)]);
            $invite3 = new Invite(['from_user_id' => Auth::user()->id, 'key' => str_random(30)]);

            $invite1->save();
            $invite2->save();
            $invite3->save();

            Invite::where('key', $request->key)->update(['to_user_id' => Auth::user()->id]);
            Invite::where('key', $request->key)->update(['used' => true]);
            Auth::user()->update(['role' => true]);
            Request::session()->flash('Upgrade', 'Sua Conta foi atualizada');
            return redirect()->action('UserController@Home');

        }else{
            Request::session()->flash('FailUpgrade', 'Chave usada não é válida');
            return redirect()->action('UserController@Upgrade');
        }

        
    }


}
