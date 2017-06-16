<?php

/**
 * User: shmeller
 * Date: 06.01.2017
 * Email: shmeller86@gmail.com
 */
class Get
{
    public static function getCorrectArray($content){
        $content = json_decode($content);
        $msg = array(
            'update_id' => $content->update_id,
            'message_id' => $content->message->message_id,
            'from_id' => $content->message->from->id,
            'from_firstname' => $content->message->from->first_name,
            'from_lastname' => $content->message->from->last_name,
            'from_username' => $content->message->from->username,
            'chat_id' => $content->message->chat->id,
            'chat_firstname' => $content->message->chat->first_name,
            'chat_lastname' => $content->message->chat->last_name,
            'chat_username' => $content->message->chat->username,
            'chat_type' => $content->message->chat->type,
            'date' => $content->message->date,
            'text' => $content->message->text,
        );
        return $msg;
    }

}