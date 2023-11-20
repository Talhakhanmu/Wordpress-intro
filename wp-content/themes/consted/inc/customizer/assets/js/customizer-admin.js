/*admin css*/
( function( consted_api ) {

	consted_api.sectionConstructor['consted_upsell'] = consted_api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
