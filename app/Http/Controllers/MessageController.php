<?php

namespace App\Http\Controllers;

use App\Events\MessageEvent;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Mailer\Event\MessageEvent as EventMessageEvent;
use Symfony\Component\Mailer\Event\MessageEvents;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getMessages(Request $request)
    {

        $connectedUserId = Auth::user()->id;
        $messages = Message::where('projet_id', $request->projet_id)
            ->with('user')
            ->get()
            ->map(function ($message) {
                $createdDate = Carbon::parse($message->created_at)->format('d/m/Y'); // Format de date française (ex: 06/06/2023)
                $createdTime = Carbon::parse($message->created_at)->format('H:i'); // Format d'heure sans les secondes (ex: 10:30)

                return [
                    "id" => $message->id,
                    "content" => $message->content,
                    "attachment" => $message->attachment,
                    "user_id" => $message->user_id,
                    "projet_id" => $message->projet_id,
                    "created_date" => $createdDate,
                    "created_time" => $createdTime,
                    "user" => [
                        "id" => $message->user->id,
                        "name" => $message->user->name,
                        // Autres attributs de l'utilisateur que vous souhaitez inclure
                    ],
                ];
            });





        // dd($messages);
        return response([
            'messages' => $messages,
            'connectedUserId' => $connectedUserId
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validation des données du formulaire

            $id = Auth::user()->id;

            // Créer un nouveau message
            $createMessage = Message::create([
                'content' => $request->content,
                'projet_id' =>  $request->projet_id,
                'user_id' => $id,
            ]);

            $createMessage->save();

            // if ($request->hasFile('attachment')) {
            //     $attachmentPath = $request->file('attachment')->store('attachments');
            //     $createMessage->attachment = $attachmentPath;
            // }

            $messages = Message::where('projet_id', $request->projet_id)
            ->with('user')
            ->get()
            ->map(function ($message) {
                $createdDate = Carbon::parse($message->created_at)->format('d/m/Y'); // Format de date française (ex: 06/06/2023)
                $createdTime = Carbon::parse($message->created_at)->format('H:i'); // Format d'heure sans les secondes (ex: 10:30)

                return [
                    "id" => $message->id,
                    "content" => $message->content,
                    "attachment" => $message->attachment,
                    "user_id" => $message->user_id,
                    "projet_id" => $message->projet_id,
                    "created_date" => $createdDate,
                    "created_time" => $createdTime,
                    "user" => [
                        "id" => $message->user->id,
                        "name" => $message->user->name,
                        // Autres attributs de l'utilisateur que vous souhaitez inclure
                    ],
                ];
            });


          

            return response($messages);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }
}
