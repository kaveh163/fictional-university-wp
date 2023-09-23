wp.blocks.registerBlockType("ourblocktheme/eventsandblogs", {
  apiVersion: 2,
  title: "Events and Blogs",

  edit: function() {
    const blockProps = wp.blockEditor.useBlockProps({className: "our-placeholder-block"});
    //second argument of createElement is an object of props. for example className
    return wp.element.createElement("div", {...blockProps }, "Events and Blogs Placeholder");
  },
  save: function() {
    return null;
  }
});
