<?php

namespace FlexPress\Components\Taxonomy;

abstract class AbstractTaxonomy
{

    /**
     * Gets the singular name
     *
     * @return string
     * @author Tim Perry
     */
    public function getSingularName()
    {
        return ucwords($this->getName());
    }

    /**
     * Gets the plural name
     *
     * @return string
     * @author Tim Perry
     */
    public function getPluralName()
    {
        return $this->getSingularName() . "s";
    }

    /**
     *
     * Gets the args
     *
     * @return array
     * @author Tim Perry
     */
    public function getArgs()
    {
        return array(
            'hierarchical' => true,
            'labels' => $this->getLabels(),
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => strtolower($this->getSingularName()))
        );
    }

    /**
     * Gets the labels used in the args
     *
     * @return array
     * @author Tim Perry
     */
    protected function getLabels()
    {
        $pluralName = $this->getPluralName();
        $singularName = $this->getSingularName();

        return array(
            'name' => _x($pluralName, strtolower($pluralName)),
            'singular_name' => _x($singularName, strtolower($singularName)),
            'search_items' => __('Search ' . $pluralName),
            'all_items' => __('All ' . $pluralName),
            'parent_item' => __('Parent ' . $singularName),
            'parent_item_colon' => __('Parent ' . $singularName . ":"),
            'edit_item' => __('Edit ' . $singularName),
            'update_item' => __('Update ' . $singularName),
            'add_new_item' => __('Add New ' . $singularName),
            'new_item_name' => __('New ' . $singularName),
            'menu_name' => __($pluralName)
        );
    }

    /**
     * Gets the name of the taxonomy
     *
     * @return string
     * @author Tim Perry
     */
    abstract public function getName();

    /**
     * Get a array of supported post types
     *
     * @return array
     * @author Tim Perry
     */
    abstract public function getSupportedPostTypes();
}
