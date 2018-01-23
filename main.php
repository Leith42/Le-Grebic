<?php

include_once 'vendor/autoload.php';

$loop = \React\EventLoop\Factory::create();
$client = new \CharlotteDunois\Yasmin\Client(array(), $loop);

$client->on('ready', function () use ($client) {
	echo 'Logged in as ' . $client->user->tag . ' created on ' . $client->user->createdAt->format('d.m.Y H:i:s') . PHP_EOL;
	$client->user->setActivity("with my fedora");
	$client->user->setStatus("only god can judge me ;)");
});

$client->on('message', function ($message) {
	echo 'Received Message from ' . $message->author->tag . ' in ' . ($message->channel->type === 'text' ? 'channel #' . $message->channel->name : 'DM') . ' with ' . $message->attachments->count() . ' attachment(s) and ' . \count($message->embeds) . ' embed(s)' . PHP_EOL;
});

$client->login(include 'token.php');

$loop->run();
