<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function listMessage(): View | RedirectResponse
    {
        if (Auth::check())
        {
            $user = Auth::user();
            if ($user->role == 'coordinator') $messages = Message::where('sender_id', $user->id)->get();
            else $messages = Message::where('receiver_id', $user->id)->get();
            return view('message.list', ['messages' => $messages, 'role' => $user->role]);
        }
        else
        {
            return redirect()->route('dashboard')->withErrors(['error' => 'You are not allowed to view messages.']);
        }
    }

    public function detailsMessage(int $id): View | RedirectResponse
    {
        if (Auth::check())
        {
            $message = Message::with(['sender', 'receiver'])->find($id);
            if ($message) {
                $message->read = 1;
                $message->save();
                return view('message.details', ['message' => $message]);
            } else {
                return redirect()->route('listMessage')->withErrors(['error' => 'Message not found.']);
            }
        }
        else
        {
            return redirect()->route('dashboard')->withErrors(['error' => 'You are not allowed to view messages.']);
        }
    }

    public function send(): View | RedirectResponse
    {
        if (Auth::check() and Auth::user()->role == "coordinator") {
            $club = Club::where('coordinator_id', Auth::user()->id)->first();
            $players = User::where('club_id', $club->id)->where('role', 'player')->get();
            return view('message.send', ['players' => $players]);
        }
        else
            return redirect()->route('dashboard')->withErrors(['error' => 'You are not allowed to send messages.']);
    }

    public function sendMessage(): RedirectResponse
    {
        if (request()->validate([
            'subject' => 'required|string',
            'message' => 'required|string',
        ]));
        {
            $data = request()->all();
            if (isset($data["send_to_all"]) and $data["send_to_all"] == true)
            {
                $club = Club::where('coordinator_id', Auth::user()->id)->first();
                $players = User::where('club_id', $club->id)->where('role', 'player')->get();
                foreach ($players as $player)
                {
                    $message = new Message();
                    $message->fill($data);
                    $message->sender_id = Auth::user()->id;
                    $message->receiver_id = $player->id;
                    $message->save();
                }
            }
            else
            {
                $message = new Message();
                $message->fill($data);
                $message->sender_id = Auth::user()->id;
                $message->receiver_id = $data["receiver"];
            }
            if ($message->save())
            {
                return redirect()->route('dashboard')->with('success', 'Message sent successfully.');
            }
            else {
                return redirect()->route('send')->withErrors(['error' => 'Message not sent.']);
            }
        }
    }

}
