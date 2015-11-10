// https://github.com/dylang/grunt-notify
module.exports = function (grunt) {
		// Return the configurations
		return {
			bump: {
				options: {
					title: "Grunt Bump it Up",
					message: '"<%= pkg.name %>" is now in version <%= pkg.version %>!'
				}
			},
			build: {
				options: {
					title: 'Grunt Built it',
					message: 'Version <%= pkg.version %> of "<%= pkg.name %>" is waiting in "/build"!'
				}
			},
			i18n: {
				options: {
					title: 'Grunt Internationalized it',
					message: 'Version <%= pkg.version %> of "<%= pkg.name %>" is ready for "l10n"!'
				}
			}
		};
	};