<?php

use yii\db\Migration;

/**
 * Class m230723_062451_init_rbac
 */
class m230723_062451_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = \Yii::$app->authManager;
        // add "article" permissions
        $listArticle = $auth->createPermission('listArticle');
        $listArticle->description = 'List all Article';
        $auth->add($listArticle);

        $createArticle = $auth->createPermission('createArticle');
        $createArticle->description = 'Create an Article';
        $auth->add($createArticle);

        $updateArticle = $auth->createPermission('updateArticle');
        $updateArticle->description = 'Update an Article';
        $auth->add($updateArticle);

        $viewArticle = $auth->createPermission('viewArticle');
        $viewArticle->description = 'View Article';
        $auth->add($viewArticle);

        $deleteArticle = $auth->createPermission('deleteArticle');
        $deleteArticle->description = 'Delete an Article';
        $auth->add($deleteArticle);

        // add "tag" permissions
        $listTag = $auth->createPermission('listTag');
        $listTag->description = 'List all Tag';
        $auth->add($listTag);

        $createTag = $auth->createPermission('createTag');
        $createTag->description = 'Create a Tag';
        $auth->add($createTag);

        $updateTag = $auth->createPermission('updateTag');
        $updateTag->description = 'Update a Tag';
        $auth->add($updateTag);

        $viewTag = $auth->createPermission('viewTag');
        $viewTag->description = 'View Tag';
        $auth->add($viewTag);

        $deleteTag = $auth->createPermission('deleteTag');
        $deleteTag->description = 'Delete a Tag';
        $auth->add($deleteTag);

        // add "user" permissions
        $listUser = $auth->createPermission('listUser');
        $listUser->description = 'List an User';
        $auth->add($listUser);

        $createUser = $auth->createPermission('createUser');
        $createUser->description = 'Create an User';
        $auth->add($createUser);

        // add "updatePost" permission
        $updateUser = $auth->createPermission('updateUser');
        $updateUser->description = 'Update an User';
        $auth->add($updateUser);

        $viewUser = $auth->createPermission('viewUser');
        $viewUser->description = 'View User';
        $auth->add($viewUser);

        $deleteUser = $auth->createPermission('deleteUser');
        $deleteUser->description = 'Delete an User';
        $auth->add($deleteUser);


        // add "manager" role and give this role the "createPost" permission
        $manager = $auth->createRole('MANAGER');
        $auth->add($manager);
        $auth->addChild($manager, $listArticle);
        $auth->addChild($manager, $viewUser);
        $auth->addChild($manager, $viewArticle);
        $auth->addChild($manager, $viewTag);
        $auth->addChild($manager, $createArticle);
        $auth->addChild($manager, $deleteArticle);
        $auth->addChild($manager, $listTag);
        $auth->addChild($manager, $createTag);
        $auth->addChild($manager, $deleteTag);
        $auth->addChild($manager, $listUser);
        $auth->addChild($manager, $createUser);

        // add "admin" role and give permissions of the "manager" role
        $admin = $auth->createRole('ADMIN');
        $auth->add($admin);
        $auth->addChild($admin, $manager);
        $auth->addChild($admin, $updateArticle);
        $auth->addChild($admin, $updateTag);
        $auth->addChild($admin, $updateUser);
        $auth->addChild($admin, $deleteUser);

        // add "user" role and give this role permissions
        $user = $auth->createRole('USER');
        $auth->add($user);


        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($manager, 2);
        $auth->assign($admin, 1);
        $auth->assign($user, 3);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
    }
}
