<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Php71\Rector\FuncCall\CountOnNullRector;
use Rector\Php80\Rector\FunctionLike\UnionTypesRector;
use Rector\TypeDeclaration\Rector\Closure\AddClosureReturnTypeRector;
use Rector\TypeDeclaration\Rector\ClassMethod\AddArrayReturnDocTypeRector;
use Rector\TypeDeclaration\Rector\FunctionLike\ParamTypeDeclarationRector;
use Rector\TypeDeclaration\Rector\Property\TypedPropertyFromAssignsRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ParamTypeByParentCallTypeRector;
use Rector\Php80\Rector\Class_\ClassPropertyAssignToConstructorPromotionRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictNewArrayRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictNativeCallRector;
use Rector\TypeDeclaration\Rector\ClassMethod\AddMethodCallBasedStrictParamTypeRector;
use Rector\TypeDeclaration\Rector\ClassMethod\AddReturnTypeDeclarationBasedOnParentClassMethodRector;

return static function (RectorConfig $rectorConfig): void {
    //$rectorConfig->phpstanConfig(__DIR__ . '/phpstan.neon');
    //$rectorConfig->symfonyContainerXml(__DIR__ . '/var/cache/dev/App_KernelDevDebugContainer.xml');

    /*$rectorConfig->sets([
      DoctrineSetList::ANNOTATIONS_TO_ATTRIBUTES,
      SymfonySetList::ANNOTATIONS_TO_ATTRIBUTES,
  ]);*/

  $rectorConfig->rule(AddClosureReturnTypeRector::class);
  $rectorConfig->rule(AddMethodCallBasedStrictParamTypeRector::class);
  $rectorConfig->rule(AddReturnTypeDeclarationBasedOnParentClassMethodRector::class);
  $rectorConfig->rule(ParamTypeByParentCallTypeRector::class);
  $rectorConfig->rule(ReturnTypeFromStrictNativeCallRector::class);
  $rectorConfig->rule(ReturnTypeFromStrictNewArrayRector::class);
  $rectorConfig->rule(ClassPropertyAssignToConstructorPromotionRector::class);
  $rectorConfig->rule(UnionTypesRector::class);
  $rectorConfig->rule(CountOnNullRector::class);

  
  


  $rectorConfig->ruleWithConfiguration(TypedPropertyFromAssignsRector::class, [
    TypedPropertyFromAssignsRector::INLINE_PUBLIC => false,
]);

    // register a single rule

    // define sets of rules
      /* $rectorConfig->sets([
        SymfonySetList::SYMFONY_60,
        SymfonySetList::SYMFONY_CODE_QUALITY,
        SymfonySetList::SYMFONY_CONSTRUCTOR_INJECTION,
        ]);*/
};
