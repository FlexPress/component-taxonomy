<?php

namespace FlexPress\Components\Taxonomy;

class Helper
{

    /**
     * @var \SplObjectStorage
     */
    protected $taxonomies;

    public function __construct(\SplObjectStorage $taxonomies, array $taxonomiesArray)
    {
        $this->taxonomies = $taxonomies;

        if (!empty($taxonomiesArray)) {

            foreach ($taxonomiesArray as $taxonomy) {

                if (!$taxonomy instanceof AbstractTaxonomy) {

                    $message = "One or more of the taxonomies you have passed to ";
                    $message .= get_class($this);
                    $message .= " does not extend the Taxonomy class.";

                    throw new \RuntimeException($message);

                }

                $this->taxonomies->attach($taxonomy);

            }

        }

    }

    /**
     * Registers all the taxonomies added
     */
    public function registerTaxonomies()
    {

        if (!function_exists('register_taxonomy')) {
            return;
        }

        $this->taxonomies->rewind();
        while ($this->taxonomies->valid()) {

            $taxonomy = $this->taxonomies->current();
            register_taxonomy($taxonomy->getName(), $taxonomy->getSupportedPostTypes(), $taxonomy->getArgs());
            $this->taxonomies->next();

        }

    }
}
