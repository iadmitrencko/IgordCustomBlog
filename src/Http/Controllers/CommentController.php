<?php

namespace Igord\CustomBlog\Http\Controllers;

class CommentController
{
    /** @var \Igord\CustomBlog\lib\View */
    private $view;

    /** @var \Igord\CustomBlog\lib\Http\Request */
    private $request;

    /** @var \Igord\CustomBlog\lib\Http\Redirect */
    private $redirect;

    /** @var \Igord\CustomBlog\Http\Request\Param\Helper */
    private $paramHelper;

    /** @var \Igord\CustomBlog\Http\Request\Validator */
    private $validator;

    /** @var \Igord\CustomBlog\Models\Posts */
    private $posts;

    /** @var \Igord\CustomBlog\Http\Controllers\NotFoundController */
    private $notFoundController;

    /** @var \Igord\CustomBlog\lib\Message\Collection\BaseInterface */
    private $messagesCollection;

    /** @var \Igord\CustomBlog\lib\Message\Factory */
    private $messageFactory;

    /** @var \Igord\CustomBlog\Models\Comments */
    private $comments;

    // ########################################

    /**
     * CommentController constructor.
     *
     * @param \Igord\CustomBlog\lib\View                             $view
     * @param \Igord\CustomBlog\lib\Http\Request                     $request
     * @param \Igord\CustomBlog\lib\Http\Redirect                    $redirect
     * @param \Igord\CustomBlog\Http\Request\Param\Helper            $paramHelper
     * @param \Igord\CustomBlog\Http\Request\Validator               $validator
     * @param \Igord\CustomBlog\Models\Posts                         $posts
     * @param \Igord\CustomBlog\Http\Controllers\NotFoundController  $notFoundController
     * @param \Igord\CustomBlog\lib\Message\Collection\BaseInterface $messagesCollection
     * @param \Igord\CustomBlog\lib\Message\Factory                  $messageFactory
     * @param \Igord\CustomBlog\Models\Comments                      $comments
     */
    public function __construct(
        \Igord\CustomBlog\lib\View $view,
        \Igord\CustomBlog\lib\Http\Request $request,
        \Igord\CustomBlog\lib\Http\Redirect $redirect,
        \Igord\CustomBlog\Http\Request\Param\Helper $paramHelper,
        \Igord\CustomBlog\Http\Request\Validator $validator,
        \Igord\CustomBlog\Models\Posts $posts,
        NotFoundController $notFoundController,
        \Igord\CustomBlog\lib\Message\Collection\BaseInterface $messagesCollection,
        \Igord\CustomBlog\lib\Message\Factory $messageFactory,
        \Igord\CustomBlog\Models\Comments $comments
    ) {
        $this->view               = $view;
        $this->request            = $request;
        $this->redirect           = $redirect;
        $this->paramHelper        = $paramHelper;
        $this->validator          = $validator;
        $this->posts              = $posts;
        $this->notFoundController = $notFoundController;
        $this->messagesCollection = $messagesCollection;
        $this->messageFactory     = $messageFactory;
        $this->comments           = $comments;
    }

    // ########################################

    /**
     * Add comment to post
     *
     * @param int $postId
     */
    public function add(int $postId)
    {
        if (is_null($this->posts->find($postId))) {
            $this->notFoundController->show();

            return;
        }

        $author = $this->paramHelper->prepareStringParam(
            $this->request->getBody()['author']
        );

        $text = $this->paramHelper->prepareStringParam(
            $this->request->getBody()['text']
        );

        $this->validator->validate($author, $text);

        if ($this->validator->isValid()) {
            $commentId = $this->comments->save($postId, $author, $text);

            $message = $this->messageFactory->create(
                \Igord\CustomBlog\lib\Message::SUCCESS_TYPE,
                "Comment with id: {$commentId} for post id: {$postId} written by '{$author}' was success created!"
            );

            $this->messagesCollection->addMessage($message);
        } else {
            foreach ($this->validator->getErrorMessages() as $errorMessage) {
                $this->messagesCollection->addMessage($errorMessage);
            }
        }

        $this->redirect->to("/post/{$postId}");

        return;
    }

    // ########################################
}