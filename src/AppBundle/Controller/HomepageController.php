<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\NewsCategory;
use AppBundle\Entity\News;

class HomepageController extends Controller
{
    public function indexAction(Request $request)
    {
        $listCategoriesOnHomepage = $this->get('settings_manager')->get('listCategoryOnHomepage');
        $blocksOnHomepage = array();

        if (!empty($listCategoriesOnHomepage)) {
            $listCategoriesOnHomepage = json_decode($listCategoriesOnHomepage, true);

            if (is_array($listCategoriesOnHomepage)) {
                for ($i = 0; $i < count($listCategoriesOnHomepage); $i++) {
                    $blockOnHomepage = [];
                    $category = $this->getDoctrine()
                                    ->getRepository(NewsCategory::class)
                                    ->find($listCategoriesOnHomepage[$i]["id"]);

                    if ($category) {
                        if ($category->getId() != 5) {
                            $posts = $this->getDoctrine()
                                ->getRepository(News::class)
                                ->findBy(
                                    array('postType' => 'post', 'enable' => 1, 'category' => $category->getId()),
                                    array('viewCounts' => 'DESC'),
                                    $listCategoriesOnHomepage[$i]["items"]
                                );
                        } else {
                            $listCategoriesIds = array($category->getId());

                            $allSubCategories = $this->getDoctrine()
                                ->getRepository(NewsCategory::class)
                                ->createQueryBuilder('c')
                                ->where('c.parentcat = (:parentcat)')
                                ->setParameter('parentcat', $category->getId())
                                ->getQuery()->getResult();

                            foreach ($allSubCategories as $value) {
                                $listCategoriesIds[] = $value->getId();
                            }

                            $posts = $this->getDoctrine()
                                ->getRepository(News::class)
                                ->createQueryBuilder('p')
                                ->where('p.category IN (:listCategoriesIds)')
                                ->andWhere('p.enable = :enable')
                                ->setParameter('listCategoriesIds', $listCategoriesIds)
                                ->setParameter('enable', 1)
                                ->orderBy('p.viewCounts', 'DESC')
                                ->getQuery()->getResult();
                        }
                    }

                    $blockOnHomepage = (object) array('category' => $category, 'posts' => $posts, 'description' => $listCategoriesOnHomepage[$i]["description"]);
                    $blocksOnHomepage[] = $blockOnHomepage;
                }
            }
        }

        return $this->render('homepage/index.html.twig', [
            'blocksOnHomepage' => $blocksOnHomepage,
            'showSlide' => true
        ]);
    }
}
