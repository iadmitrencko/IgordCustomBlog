<?php

namespace Igord\CustomBlog\Http\Controllers;

class PostController
{
    /** @var \Igord\CustomBlog\lib\View */
    private $view;

    /** @var \Igord\CustomBlog\Models\Posts */
    private $posts;

    /** @var \Igord\CustomBlog\Http\Controllers\NotFoundController */
    private $notFoundController;

    /** @var \Igord\CustomBlog\Models\Comments */
    private $comments;

    /** @var \Igord\CustomBlog\lib\Http\Request */
    private $request;

    /** @var \Igord\CustomBlog\lib\Http\Redirect */
    private $redirect;

    /** @var \Igord\CustomBlog\Http\Request\Param\Helper */
    private $paramHelper;

    /** @var \Igord\CustomBlog\Http\Request\Validator */
    private $validator;

    /** @var \Igord\CustomBlog\lib\Message\Collection\BaseInterface */
    private $messagesCollection;

    /** @var \Igord\CustomBlog\lib\Message\Factory */
    private $messageFactory;

    // ########################################

    /**
     * PostController constructor.
     *
     * @param \Igord\CustomBlog\lib\View                             $view
     * @param \Igord\CustomBlog\Models\Posts                         $posts
     * @param \Igord\CustomBlog\Http\Controllers\NotFoundController  $notFoundController
     * @param \Igord\CustomBlog\Models\Comments                      $comments
     * @param \Igord\CustomBlog\lib\Http\Request                     $request
     * @param \Igord\CustomBlog\lib\Http\Redirect                    $redirect
     * @param \Igord\CustomBlog\Http\Request\Param\Helper            $paramHelper
     * @param \Igord\CustomBlog\Http\Request\Validator               $validator
     * @param \Igord\CustomBlog\lib\Message\Collection\BaseInterface $messagesCollection
     * @param \Igord\CustomBlog\lib\Message\Factory                  $messageFactory \
     */
    public function __construct(
        \Igord\CustomBlog\lib\View $view,
        \Igord\CustomBlog\Models\Posts $posts,
        NotFoundController $notFoundController,
        \Igord\CustomBlog\Models\Comments $comments,
        \Igord\CustomBlog\lib\Http\Request $request,
        \Igord\CustomBlog\lib\Http\Redirect $redirect,
        \Igord\CustomBlog\Http\Request\Param\Helper $paramHelper,
        \Igord\CustomBlog\Http\Request\Validator $validator,
        \Igord\CustomBlog\lib\Message\Collection\BaseInterface $messagesCollection,
        \Igord\CustomBlog\lib\Message\Factory $messageFactory
    ) {
        $this->view               = $view;
        $this->posts              = $posts;
        $this->notFoundController = $notFoundController;
        $this->comments           = $comments;
        $this->request            = $request;
        $this->redirect           = $redirect;
        $this->paramHelper        = $paramHelper;
        $this->validator          = $validator;
        $this->messagesCollection = $messagesCollection;
        $this->messageFactory     = $messageFactory;
    }

    // ########################################

    /**
     * Render post page
     *
     * @param int $id
     */
    public function show(int $id)
    {
        $post = $this->posts->find($id);
        if (is_null($post)) {
            $this->notFoundController->show();

            return;
        }

        $comments = $this->comments->findByPostId($id);

        $this->view->render('pages/post.php', [
            'title'    => 'Post ' . $id,
            'post'     => $post,
            'comments' => $comments
        ]);

        return;
    }

    /**
     * Save post
     */
    public function add()
    {
        $author = $this->paramHelper->prepareStringParam(
            $this->request->getBody()['author']
        );

        $text = $this->paramHelper->prepareStringParam(
            $this->request->getBody()['text']
        );

        $this->validator->validate($author, $text);

        if ($this->validator->isValid()) {
            $postId = $this->posts->save($author, $text);

            $message = $this->messageFactory->create(
                \Igord\CustomBlog\lib\Message::SUCCESS_TYPE,
                "Post with id: {$postId} written by '{$author}' was success created!"
            );

            $this->messagesCollection->addMessage($message);
        } else {
            foreach ($this->validator->getErrorMessages() as $errorMessage) {
                $this->messagesCollection->addMessage($errorMessage);
            }
        }

        $this->redirect->to('/');

        return;
    }

    // ########################################
}