wp.blocks.registerBlockType("ourblocktheme/eventsandblogs", {
  apiVersion: 2,
  title: "Events and Blogs",

  edit: function() {
    //second argument of createElement is an object of props. for example className
    return wp.element.createElement("div", {className: "our-placeholder-block"}, "Events and Blogs Placeholder");
  },
  save: function() {
    return null;
  }
});
