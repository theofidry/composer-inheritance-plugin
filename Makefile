.DEFAULT_GOAL := test
.PHONY: test


help:
	@fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep | sed -e 's/\\$$//' | sed -e 's/##//'


##
## Tests
##---------------------------------------------------------------------------

test:		## Run all the tests
test: vendor fixtures/vendor fixtures/vendor-bin/sub/vendor
	composer validate --no-interaction

	php tests/root.php > root.actual
	php tests/sub.php > sub.actual

	diff tests/root.expected root.actual
	diff tests/sub.expected sub.actual

	rm root.actual
	rm sub.actual


##
## Rules from files
##---------------------------------------------------------------------------

vendor:
	composer update
	touch $@

fixtures/vendor:
	composer update --working-dir fixtures --no-interaction ${COMPOSER_FLAGS}
	touch $@

fixtures/vendor-bin/sub/vendor:
	composer update --working-dir fixtures/vendor-bin/sub --no-interaction ${COMPOSER_FLAGS}
	touch $@
