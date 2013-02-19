//
//  HHArticleModel.m
//  ZHAW HandHeld
//
//  Created by Alexander Gustafson on 12.02.13.
//  Copyright (c) 2013 Alexander Gustafson. All rights reserved.
//

#import "HHArticleModel.h"
#import "AppDelegate.h"
#import "ComputerMusuemStartView.h"

@implementation HHArticleModel
@synthesize name, template_id, data, template;
- (id)initWithDBManager:(SqLiteDatabaseManager *)dbManager andDocumentArray:(NSArray *)articleArray
{
    self = [super init];
    if (self) {
        
        _dbManager = dbManager;
        [self setName:[articleArray valueForKey:@"name"]];
        [self setTemplate_id:[articleArray valueForKey:@"template_id"]];
        //[self setData:[articleArray valueForKey:@"data"]];
        
        
        [self setData:[NSJSONSerialization JSONObjectWithData:[[articleArray valueForKey:@"data"] dataUsingEncoding:NSUTF8StringEncoding] options:NSJSONReadingMutableContainers  error:nil]];
        [self setTemplate:[[HHTemplateModel alloc] initWithDBManager:dbManager andTemplateArray:[dbManager getTemplateArrayForTemplateID:self.template_id]]];
        
    }
    return self;
}

- (UIViewController *)getViewControllerForTemplate
{
    
    UIViewController *articleView;
    
    switch ([self.template_id intValue]) {
        case 22:
            
            articleView = [[ComputerMusuemStartView alloc] init];
            [(ComputerMusuemStartView *)articleView initializeWithArticle:self];
            
            break;
            
        default:
            break;
    }
    
    return (UIViewController *)articleView;
    
}

@end
