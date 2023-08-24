// name of the our-blocks directory could be anything
// instead of wp.blockEditor.InnerBlocks use below for wordpress scripts package
// The InnerBlocks component lets us to click on the plus symbol in the block editor
// to start adding new blocks inside our block
// To restrict the blocks we can add to our block, use allowedBlocks prop in InnerBlock Component
import { InnerBlocks } from "@wordpress/block-editor";
// first argument: namespace for all our blocks, and name for our specific block
wp.blocks.registerBlockType("ourblocktheme/banner", {
  title: "Banner",
  edit: EditComponent,
  save: SaveComponent,
});

function EditComponent() {
  const useMeLater = (
    <>
      <h1 className="headline headline--large">Welcome!</h1>
      <h2 className="headline headline--medium">
        We think you&rsquo;ll like it here.
      </h2>
      <h3 className="headline headline--small">
        Why don&rsquo;t you check out the <strong>major</strong> you&rsquo;re
        interested in?
      </h3>
      <a href="#" className="btn btn--large btn--blue">
        Find Your Major
      </a>
    </>
  );
  return (
    <div className="page-banner">
      <div
        className="page-banner__bg-image"
        style={{
          backgroundImage:
            "url('/fictional-university/wp-content/themes/fictional-block-theme/images/library-hero.jpg')",
        }}
      ></div>
      <div className="page-banner__content container t-center c-white">
        <InnerBlocks allowedBlocks={["core/paragraph", "core/heading", "core/list"]}/>
      </div>
    </div>
  );
}
// return content of SaveComponent will be saved in database
function SaveComponent() {
  return (
    <div className="page-banner">
      <div
        className="page-banner__bg-image"
        style={{
          backgroundImage:
            "url('/fictional-university/wp-content/themes/fictional-block-theme/images/library-hero.jpg')",
        }}
      ></div>
      <div className="page-banner__content container t-center c-white">
        <InnerBlocks.Content />
      </div>
    </div>
  );
}