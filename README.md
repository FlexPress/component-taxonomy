# FlexPress taxonomy component

## Install with Pimple
The taxonomy component uses two classes:
- AbstractTaxonommy, which you extend to create a taxonomy.
- TaxonomyHelper, which hooks into everything for you and registers the taxonomies.

Lets create a pimple config for both of these

```
$pimple["documentTypeTaxonomy"] = function () {
  return new DocumentType();
};

$pimple['taxonomyHelper'] = function ($c) {
    return new TaxonomyHelper($c['objectStorage'], array(
        $c["documentTypeTaxonomy"]
    ));
};
```
- Note the dependency $c['objectStorage']  is a SPLObjectStorage

## Creating a concreate Taxonomy class
Create a concreate class that implements the AbstractTaxonomy class and implements the getName() and getSupportedPostTypes() methods.

```
class DocumentType extends AbstractTaxonomy {

    public function getName()
    {
      return "document-type";
    }
    
    public function getSupportedPostTypes()
    {
      return array("document");
    }

}
```
This above example is the bare minimum you must implement, the example that follows is the other extreme implementing all available methods.
```
class DocumentType extends AbstractTaxonomy {

  public function getName()
  {
    return "document-type";
  }
  
  public function getSupportedPostTypes()
  {
    return array("document");
  }

  protected function getLabels()
  {
    $labels = parent::getLabels();
    $labels['menu_name'] = 'Type';
    return $labels;
  }
  
  public function getArgs()
  {
    $args = parent::getArgs();
    $args['query_var'] = false;
    return $args;
  }
  
  public function getPluralName()
  {
    return "Docs";
  }
  
  public function getSingularName()
  {
    return "Doc";
  }

}
```

### Public Methods
- getSingularName() - returns the singular name of the taxonomy.
- getPluralName() - returns the plural name of the taxonomy.
- getArgs() - returns the array of args.
- getLabels() - Returns the array of labels.
- getName() - Returns taxonomy name.
- getSupportedPostTypes() - Return an array of post types the taxonomy should be attached to.

## TaxonomyHelper usage

Once you have setup the pimple config you are use the TaxonomyHelper like this
```
$helper = $pimple['taxonomyHelper'];
$helper->registerTaxonomies();

```
That's it, the helper will then add all the needed hooks and register all the taxonomies you have provided it.

### Public methods
- registerTaxonomies() - Registers the taxonomies provided.
